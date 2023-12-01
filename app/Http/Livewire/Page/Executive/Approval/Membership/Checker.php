<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Checker extends Component
{
    public User $User;
    public Approval $Approval;
    public ApplyMembership $Checker;
    public $banks;
    public $forward = false;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'           => ['required','max:255'],
        'Checker.share_fee'       => ['required','gt:0'],
        'Checker.share_monthly'   => ['required','gt:0'],
        'Checker.register_fee'    => ['required','gt:0'],
        'Checker.contribution_fee'=> ['required','gt:0'],
    ];

    public function forward() {
        $this->validate();
        $this->approval_type = 'Send to next level';
        $this->message       = 'Application send to next level';
        $this->next();
    }

    public function decline() {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {
        $this->validate();
        $this->Checker->step++;
        $this->Checker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->Checker->sendWS('SISKOPv3 Membership Application ('.$this->Checker->coop->name.') have been pre-approved by CHECKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Checker->sendSMS('RM0 SISKOPv3 Membership Application ('.$this->Checker->coop->name.') have been pre-approved by CHECKER');
        }

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Checker->step > 1){
            $this->Checker->step--;
            $this->Checker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');
            session()->flash('time', 10000);

            return redirect()->route('application.list',['page' => '1']);
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

    public function cancel() {
        
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Checker  = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->Checker->id],
                            ['order', $this->Checker->step],
                            ['role_id', '2'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
        $this->forward  = $this->Approval->rule_forward ?? FALSE;
    }

    public function deb() {
        dd([
            'approvals' => $this->Checker->approvals,
            'approval'  => $this->Approval, 
            'checker'   => $this->Checker,
            'forward'   => $this->forward,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.checker')->extends('layouts.head');
    }
}