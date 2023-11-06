<?php

namespace App\Http\Livewire\Page\Executive\Approval\Financing;

use App\Models\AccountApplication;
use App\Models\AccountDeduction;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class FinancingCommittee extends Component
{
    public AccountApplication $Account;
    public AccountDeduction $Deduction;
    public Approval $Approval;
    public Customer $Customer;
    public User $User;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

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
        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {
        $this->validate();

        $this->Approval->vote = $this->approval_type;
        $this->Approval->save();

        $this->checkvote();
        $this->Account->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', '10000');

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

    public function doApproval() {
        if ($this->Approval->rule_whatsapp){
            //$this->Account->sendWS('SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }

        if ($this->Approval->rule_sms){
            //$this->Account->sendSMS('RM0 SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }
    }

    public function checkvote() {
        //checks if vote unanimous is checked true, and votes are contradictory
        if ($this->Account->current_approval()->rule_vote && $this->Account->approval_vote_yes() > 0 && $this->Account->approval_vote_no() > 0){
            $this->Account->apply_step++;
        }

        //else, check if all votes are casted
        else if ($this->Account->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            $this->Account->apply_step++;
            $this->doApproval();
        }
    }

    public function cancel()
    {
        //
    }

    public function debug()
    {
        dd([
            'Account'  => $this->Account,
            'Approval' => $this->Approval,
            'approvals'=> $this->Account->approvals,
            'vote yes' => $this->Account->approval_vote_yes(),
            'vote no'  => $this->Account->approval_vote_no(),
        ]);
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
                                ['approval_type','App\Models\AccountApplication']
                          ])->firstOrFail();
        $this->Customer = Customer::find($this->Account->cust_id);

        if ($this->Approval->vote != NULL){
            session()->flash('message', 'You already voted');
            session()->flash('warning');
            session()->flash('title', 'Warning!');
            session()->flash('time', '10000');

            return redirect()->route('application.list');
        }
    }

    public function render()
    {
        return view('livewire.page.executive.approval.financing.committee')->extends('layouts.head');
    }
}
