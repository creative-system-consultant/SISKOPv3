<?php

namespace App\Http\Livewire\Page\Executive\Approval\Financing;

use App\Models\AccountApplication;
use App\Models\AccountDeduction;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class FinancingApprover extends Component
{
    public AccountApplication $Account;
    public AccountDeduction $Deduction;
    public Approval $Approval;
    public Customer $Customer;
    public User $User;

    protected $rules = [
        'Account.purchase_price'   => 'required',
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
        if ($this->Account->approvals()->where('type','like','vote%')->whereNull('vote')->count() <= 1){
            $this->Account->account_status = 1;

            if ($this->Approval->rule_whatsapp){
                $this->Account->sendWS('SISKOPv3 Application '.$this->Account->product->name.' have been approved by APPROVER');
            }

            if ($this->Approval->rule_sms){
                $this->Account->sendSMS('RM0 SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by MAKER');
            }
        }
        $this->Account->save();
        $this->Approval->vote = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list');
    }

    public function back()
    {
        if ($this->Account->apply_step > 1){
            $this->Account->apply_step--;
            $this->Account->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

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

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Account  = AccountApplication::where('uuid', $uuid)->firstOrFail();
        $this->Deduction= $this->Account->deduction()->firstOrCreate();
        $this->Approval = Approval::where([
                                ['approval_id', $this->Account->id],
                                ['order',       $this->Account->apply_step],
                                ['user_id',     $this->User->id],
                                ['approval_type','App\Models\AccountApplication'],
                          ])->firstOrFail();
        $this->Customer = Customer::find($this->Account->cust_id);

        if ($this->Approval->vote != NULL){
            session()->flash('message', 'You already voted');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list');
        }
    }

    public function debug()
    {
        dd([
            'User'      => $this->User,
            'Account'   => $this->Account,
            'customer'  => date('Y'),
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.financing.approver')->extends('layouts.head');
    }
}
