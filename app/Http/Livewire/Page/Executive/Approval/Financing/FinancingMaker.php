<?php

namespace App\Http\Livewire\Page\Executive\Approval\Financing;

use App\Models\AccountApplication;
use App\Models\AccountDeduction;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class FinancingMaker extends Component
{
    public AccountApplication $Account;
    public AccountDeduction $Deduction;
    public Approval $Approval;
    public Customer $Customer;
    public User $User;
    public $profit;

    protected $rules = [
        'Account.purchase_price'   => 'required',
        'Account.approved_limit'   => 'required',
        'Account.selling_price'    => 'required',
        'Account.approved_duration'=> 'required',
        'Account.instal_amount'    => 'required',
        'Deduction.process_fee'    => 'required|numeric|gt:0',
        'Deduction.duty_stamp'     => 'required|numeric|gt:0',
        'Deduction.insurance'      => 'required|numeric',
        'Approval.note'            => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        $this->Account->apply_step++;
        $this->Account->save();
        $this->Deduction->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->Account->sendWS('SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by MAKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Account->sendSMS('RM0 SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by MAKER');
        }

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list');
    }

    public function back()
    {
        if ($this->Account->apply_step > 1){
            $this->Account->apply_step--;
            $this->Account->save();
            $this->Deduction->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('time', '10000');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list');
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 10000,
            ]);
        }
    }

    public function debug()
    {
        dd([
            'Account'  => $this->Account,
            'Approval' => $this->Approval,
            'approvals'=> $this->Account->approvals,
            'deduction'=> $this->Deduction,
        ]);
    }

    public function cancel()
    {
        //
    }

    public function calculate() {
        $amount   = $this->Account->approved_limit;
        $rate     = $this->Account->profit_rate;
        $duration = $this->Account->approved_duration;
        $profit  = $amount * ($duration / 12 * ($rate/100));

        $this->profit = number_format($profit,2,'.','');
        $this->Account->selling_price = number_format($amount+$profit,2,'.','');
        $this->Account->instal_amount = number_format(($profit+$amount) / $duration,2,'.','');
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Account  = AccountApplication::where('uuid', $uuid)->firstOrFail();
        $this->Deduction= $this->Account->deduction()->firstOrCreate();
        //$this->Approval = Approval::where([['approval_id', $this->Account->id],['approval_type','App\Models\AccountApplication'],['order', $this->Account->apply_step]])->firstOrFail();
        $this->Customer = Customer::find($this->Account->cust_id);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.financing.maker')->extends('layouts.head');
    }
}
