<?php

namespace App\Http\Livewire\Page\Executive\Approval\BuyShare;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class Resolution extends Component
{
    public User $User;
    public Approval $Approval;
    public Share $Resolution;
    public $bank;
    public $flag = 20;
    public $approval_type = 'lulus';
    public $message = 'Application is Approved';

    protected $rules = [
        'Approval.note'      => 'required|max:255',
        'Resolution.approved_amt' => 'required',
    ];

    public function decline() {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->flag          = 24;
        $this->message       = 'Application is declined';
        $this->next();
    }

    public function doApproval(){
        if ($this->Approval->rule_whatsapp){
            //$this->Account->sendWS('SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }

        if ($this->Approval->rule_sms){
            //$this->Account->sendSMS('RM0 SISKOPv3 Application '.$this->Account->product->name.' have been pre-approved by COMMITTEE');
        }

        // put event to Stored Proc
        // put event here
    }

    public function next()
    {
        $this->validate();
        $this->Resolution->flag = $this->flag;
        $this->Resolution->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        $this->doApproval();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->Resolution->step > 1){
            $this->Resolution->step--;
            $this->Resolution->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('time', 10000);
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => '2']);
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
        $this->Resolution  = Share::where('uuid', $uuid)->with('customer')->first();
        $this->bank     = RefBank::where('code', $this->Resolution->bank_code)->first()->description;
        $this->Approval = Approval::where([
            ['approval_id', $this->Resolution->id],
            ['order', $this->Resolution->step],
            ['role_id', '5'],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
    }

    public function deb(){
        dd([
            'share'=>$this->Resolution,
            'bank' => $this->bank,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-resolution')->extends('layouts.head');
    }
}
