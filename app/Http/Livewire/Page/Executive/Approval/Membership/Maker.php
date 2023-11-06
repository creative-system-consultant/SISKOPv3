<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Maker extends Component
{
    public User $User;
    public ApplyMembership $Maker;
    public Approval $Approval;
    public $banks;

    protected $rules = [
        'Approval.note'         => ['required','max:255'],
        'Maker.share_fee'       => ['required','gt:0'],
        'Maker.share_monthly'   => ['required','gt:0'],
        'Maker.register_fee'    => ['required','gt:0'],
        'Maker.contribution_fee'=> ['required','gt:0'],
    ];

    public function next()
    {
        $this->validate();
        $this->Maker->step++;
        $this->Maker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->Maker->sendWS('SISKOPv3 Membership Application ('.$this->Maker->coop->name.') have been pre-approved by MAKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Maker->sendSMS('RM0 SISKOPv3 Membership Application ('.$this->Maker->coop->name.') have been pre-approved by MAKER');
        }

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Maker->step > 1){
            $this->Maker->step--;
            $this->Maker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

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

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Maker    = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->Maker->id],
                            ['order', $this->Maker->step],
                            ['role_id', '1'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
    }

    public function deb() {
        dd([
            'roles'     => $this->User->role_ids(),
            'approvals' => $this->Maker->approvals,
            'approval'  => $this->Approval, 
            'Maker'     => $this->Maker,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.maker')->extends('layouts.head');
    }
}
