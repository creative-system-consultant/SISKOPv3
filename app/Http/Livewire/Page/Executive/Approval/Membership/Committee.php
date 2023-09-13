<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Committee extends Component
{
    public User $User;
    public Approval $Approval;
    public $Committee;
    public $banks;

    protected $rules = [
        'Approval.note'     => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        if ($this->Committee->approvals()->where('type','like','vote%')->whereNull('vote')->count() <= 1){
            $this->Committee->step++;

            if ($this->Approval->rule_whatsapp){
                $this->Committee->sendWS('SISKOPv3 Membership Application ('.$this->Committee->coop->name.') have been pre-approved by COMMITTEE');
            }
    
            if ($this->Approval->rule_sms){
                $this->Committee->sendSMS('RM0 SISKOPv3 Membership Application ('.$this->Committee->coop->name.') have been pre-approved by COMMITTEE');
            }
        }

        $this->Committee->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Committee->step > 1){
            $this->Committee->step--;
            $this->Committee->save();

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
                'timer' => 3500,
            ]);
        }
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Committee = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                        ['approval_id', $this->Committee->id],
                        ['order', $this->Committee->step],
                        ['user_id', $this->User->id],
                        ['approval_type', 'App\Models\ApplyMembership'],
                    ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.committee')->extends('layouts.head');
    }
}
