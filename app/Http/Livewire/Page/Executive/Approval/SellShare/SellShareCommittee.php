<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class SellShareCommittee extends Component
{
    public User $User;
    public Approval $Approval;
    public $committee;
    public $banks;

    protected $rules = [
        'Approval.note' => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        if ($this->Committee->approvals()->where('type','like','vote%')->whereNull('vote')->count() <= 1){
            $this->Committee->step++;

            if ($this->Approval->rule_whatsapp){
                //$this->committee->sendWS('Sell Share Application have been pre-approved by COMMITTEE');
            }

            if ($this->Approval->rule_sms){
                //$this->committee->sendSMS('RM0 Sell Share Application have been pre-approved by COMMITTEE');
            }
        }

        $this->committee->save();
        $this->Approval->vote = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '3']);
    }

    public function back()
    {
        if ($this->committee->step > 1){
            $this->committee->step--;
            $this->committee->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => '3']);
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
        $this->committee= Share::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->committee->id],
                            ['order', $this->committee->step],
                            ['user_id', $this->User->id],
                            ['role_id', '3'],
                            ['approval_type', 'App\Models\Share'],
                        ])->firstOrFail();
       $this->banks = RefBank::where('client_id', $this->committee->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-committee')->extends('layouts.head');
    }
}
