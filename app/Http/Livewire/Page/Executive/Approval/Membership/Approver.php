<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Approver extends Component
{
    public User $User;
    public Approval $Approval;
    public $Approver;
    public $banks;

    protected $rules = [
        'Approval.note'     => 'required',
    ];

    public function next()
    {
        $this->validate();
        if ($this->Approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() <= 1){
            $this->Approver->flag = 20;
            $num = $this->User->id;
            $newnum = date('y').str_pad($this->User->client_id,3,'0',STR_PAD_LEFT).str_pad($num,6,'0',STR_PAD_LEFT);
            $this->Approver->Customer->ref_no = $newnum;
            $this->Approver->Customer->save();

            if ($this->Approval->rule_whatsapp){
                $this->Approver->sendWS('SISKOPv3 Membership Application ('.$this->Approver->coop->name.') have been approved by APPROVER');
            }
    
            if ($this->Approval->rule_sms){
                $this->Approver->sendSMS('RM0 SISKOPv3 Membership Application ('.$this->Approver->coop->name.') have been approved by APPROVER');
            }
        }
        $this->Approver->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Approver->step > 1){
            $this->Approver->step--;
            $this->Approver->save();

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
        $this->Approver = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                        ['approval_id', $this->Approver->id],
                        ['order', $this->Approver->step],
                        ['user_id', $this->User->id],
                        ['approval_type', 'App\Models\ApplyMembership'],
                    ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.approver')->extends('layouts.head');
    }
}
