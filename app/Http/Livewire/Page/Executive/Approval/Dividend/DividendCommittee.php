<?php

namespace App\Http\Livewire\Page\Executive\Approval\Dividend;

use App\Models\ApplyDividend;
use App\Models\Approval;
use App\Models\Customer;
use App\Models\Dividend;
use App\Models\User;
use Livewire\Component;

class DividendCommittee extends Component
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

    public function next($vote = 'approve')
    {
        $this->validate();

        $this->Approval->vote = $vote == 'approve' ? 'lulus' : 'gagal';
        $this->Approval->user_id = $this->User->id;
        $this->Approval->save();

        $mes     = 'Application Dividend Payout Pre-Approved';

        if ($this->Apply->count_unvote(3) == 0){
            if ($this->Apply->vote_result(3)){
                $mes_ws  = 'SISKOPv3 Application have been Approved by COMMITTEE';
                $mes_sms = 'RM0 SISKOPv3 Application have been Approved by COMMITTEE';
                $mes     = 'Application Dividend Payout Approved';
            } else {
                $mes_ws  = 'SISKOPv3 Application have been Rejected by COMMITTEE';
                $mes_sms = 'RM0 SISKOPv3 Application have been Rejected by COMMITTEE';
                $mes     = 'Application Dividend Payout Rejected';
            }
            $this->Apply->step++;
            $this->Apply->save();

            if ($this->Approval->rule_whatsapp){
                $this->Apply->sendWS($mes_ws);
            }

            if ($this->Approval->rule_sms){
                $this->Apply->sendSMS($mes_sms);
            }
        }
        $this->Apply->save();

        session()->flash('message', $mes);
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
                'timer' => 3500,
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
            ['approval_id',   $this->Apply->id],
            ['approval_type', 'App\Models\ApplyDividend'],
            ['user_id',       $this->User->id],
            ['order',         $this->Apply->step]
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.dividend.committee')->extends('layouts.head');
    }
}
