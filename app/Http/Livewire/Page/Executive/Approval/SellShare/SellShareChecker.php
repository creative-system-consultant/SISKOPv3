<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class SellShareChecker extends Component
{
    public User $User;
    public Approval $Approval;
    public $checker;
    public $banks;

    protected $rules = [
        'Approval.note' => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        $this->checker->step++;
        $this->checker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->checker->sendWS('Sell Share Application have been pre-approved by CHECKER');
        }

        if ($this->Approval->rule_sms){
            //$this->checker->sendSMS('RM0 Sell Share Application have been pre-approved by CHECKER');
        }

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '3']);
    }

    public function back()
    {
        if ($this->checker->step > 1){
            $this->checker->step--;
            $this->checker->save();

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
        $this->checker  = Share::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->checker->id],
                            ['order', $this->checker->step],
                            ['role_id', '2'],
                            ['approval_type', 'App\Models\Share'],
                        ])->firstOrFail();
       $this->banks = RefBank::where('client_id', $this->checker->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-checker')->extends('layouts.head');
    }
}
