<?php

namespace App\Http\Livewire\Page\Executive\Approval\Dividend;

use App\Models\ApplyDividend;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Dividend;
use App\Models\User;
use Livewire\Component;

class DividendChecker extends Component
{
    public ApplyDividend $Apply;
    public Dividend $Dividend;
    public Approval $Approval;
    public Customer $Cust;
    public User $User;
    public $payout;

    protected $rules = [
        'Approval.note'             => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();

        $this->Apply->step++;
        $this->Apply->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->Apply->sendWS('SISKOPv3 Application Dividend Payout have been pre-approved by CHECKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Apply->sendSMS('RM0 SISKOPv3 Application Dividend Payout have been pre-approved by CHECKER');
        }

        session()->flash('message', 'Application Dividend Payout Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '7']);
    }

    public function back()
    {
        if ($this->Apply->step > 1){
            $this->Apply->step--;
            $this->Apply->save();

            session()->flash('message', 'Application Dividend Payout Backtracked');
            session()->flash('success');
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
            'Dividend' => $this->Apply,
            'Approval' => $this->Approval,
            'approvals'=> $this->Apply->approvals,
        ]);
    }

    public function cancel()
    {
        //
    }

    public function mount($uuid)
    {
        $this->User      = User::find(auth()->user()->id);
        $this->Apply     = ApplyDividend::where('uuid', $uuid)->firstOrFail();
        $this->Cust      = Customer::find($this->Apply->cust_id);
        $this->Dividend  = Dividend::where([['client_id', $this->User->client_id],['cust_id', $this->Cust->id]])->first();

        $this->Approval  = Approval::where([
            ['approval_id', $this->Apply->id],
            ['approval_type','App\Models\ApplyDividend'],
            ['order', $this->Apply->step]
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.dividend.checker')->extends('layouts.head');
    }
}
