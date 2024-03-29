<?php

namespace App\Http\Livewire\Page\Executive\Approval\Financing;

use App\Models\AccountApplication;
use App\Models\AccountDeduction;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class FinancingResolution extends Component
{
    public AccountApplication $Account;
    public AccountDeduction $Deduction;
    public Approval $Approval;
    public Customer $Customer;
    public User $User;
    public $astatus = 20;
    public $lstatus = 'lulus';
    public $message = 'Application Approved';

    protected $rules = [
        'Account.purchase_price'   => 'required',
        'Account.profit_rate'      => 'required',
        'Account.approved_limit'   => 'required',
        'Account.approved_duration'=> 'required',
        'Account.instal_amount'    => 'required',
        'Deduction.process_fee'    => 'required|numeric|gt:0',
        'Deduction.duty_stamp'     => 'required|numeric|gt:0',
        'Deduction.insurance'      => 'required|numeric',
        'Approval.note'            => 'required|max:255',
    ];

    public function decline() {
        $this->validate();
        $this->message = 'Application Rejected';
        $this->astatus = 25; //resolution reject
        $this->lstatus = 'gagal';

        $this->next();
    }

    public function next()
    {
        $this->validate();
        $this->Account->account_status = $this->astatus;
        $this->Account->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->lstatus;
        $this->Approval->save();

        $this->doApproval();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', '10000');

        return redirect()->route('application.list');
    }

    public function doApproval() {
        if ($this->Approval->rule_whatsapp){
            //$this->Account->sendWS('SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }

        if ($this->Approval->rule_sms){
            //$this->Account->sendSMS('RM0 SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }

        // put event to Stored Proc
        // put event here
    }

    public function back()
    {
        if ($this->Account->apply_step > 1){
            $this->Account->apply_step--;
            $this->Account->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');
            session()->flash('time', '10000');

            return redirect()->route('application.list');
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'Application cant go back anymore',
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
        ]);
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Account  = AccountApplication::where('uuid', $uuid)->firstOrFail();
        $this->Deduction= $this->Account->deduction()->firstOrCreate();
        $this->Approval = Approval::where([['approval_id', $this->Account->id],['approval_type','App\Models\AccountApplication'],['order', $this->Account->apply_step]])->firstOrFail();
        $this->Customer = Customer::find($this->Account->cust_id);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.financing.resolution')->extends('layouts.head');
    }
}
