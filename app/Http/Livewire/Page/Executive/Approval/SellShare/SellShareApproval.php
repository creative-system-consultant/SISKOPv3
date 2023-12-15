<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class SellShareApproval extends Component
{
    public User $User;
    public Approval $Approval;
    public $approver;
    public $banks;

    protected $rules = [
        'Approval.note' => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        if ($this->approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() <= 1){
            $this->approver->step++;
            $this->approver->flag = 20;

            if ($this->Approval->rule_whatsapp){
                //$this->approver->sendWS('Sell Share Application have been voted approved by APPROVER');
            }

            if ($this->Approval->rule_sms){
                //$this->approver->sendSMS('RM0 Sell Share Application have voted approved by APPROVER');
            }
        }

        $this->approver->save();
        $this->Approval->vote = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application voted Approve');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '3']);
    }

    public function back()
    {
        if ($this->approver->step > 1){
            $this->approver->step--;
            $this->approver->save();

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
        $this->approver= Share::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->approver->id],
                            ['order', $this->approver->step],
                            ['user_id', $this->User->id ],
                            ['role_id', '4'],
                            ['approval_type', 'App\Models\Share'],
                        ])->firstOrFail();
       $this->banks = RefBank::where('client_id', $this->approver->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-approval')->extends('layouts.head');
    }
}
