<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class SellShareMaker extends Component
{
    public Approval $Approval;
    public User $User;
    public $Maker;
    public $banks;

    protected $rules = [
        'Approval.note' => 'required|max:255',
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
            //$this->Maker->sendWS('Share Application have been pre-approved by MAKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Maker->sendSMS('RM0 Share Application have been pre-approved by MAKER');
        }

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '3']);
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

    public function deb()
    {
        dd([
            'Maker' => $this->Maker,
        ]);
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Maker    = Share::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->Maker->id],
                            ['order', $this->Maker->step],
                            ['role_id', '1'],
                            ['approval_type', 'App\Models\Share'],
                        ])->firstOrFail();
       $this->banks = RefBank::where('client_id', $this->Maker->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-maker')->extends('layouts.head');
    }
}
