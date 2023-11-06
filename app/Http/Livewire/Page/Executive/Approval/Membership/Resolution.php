<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Resolution extends Component
{
    public User $User;
    public Approval $Approval;
    public ApplyMembership $Resolution;
    public $banks;
    public $approval_type = 'lulus';
    public $approval_code = 20;
    public $message = 'Application Approved';

    protected $rules = [
        'Approval.note'           => ['required','max:255'],
        'Resolution.share_fee'       => ['required','gt:0'],
        'Resolution.share_monthly'   => ['required','gt:0'],
        'Resolution.register_fee'    => ['required','gt:0'],
        'Resolution.contribution_fee'=> ['required','gt:0'],
    ];

    public function decline() {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->approval_code = 25;
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function doApproval(){
        $num = $this->User->id;
        $newnum = date('y').str_pad($this->User->client_id,3,'0',STR_PAD_LEFT).str_pad($num,6,'0',STR_PAD_LEFT);
        $this->Resolution->Customer->ref_no = $newnum;
        $this->Resolution->Customer->save();

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
        $this->Resolution->flag = $this->approval_code;
        $this->Resolution->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        if ($this->approval_type = 'lulus'){
            $this->doApproval();
        }

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Resolution->step > 1){
            $this->Resolution->step--;
            $this->Resolution->save();

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

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Resolution  = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->Resolution->id],
                            ['order', $this->Resolution->step],
                            ['role_id', '5'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
    }

    public function deb() {
        dd([
            'approvals' => $this->Resolution->approvals,
            'approval'  => $this->Approval, 
            'Resolution'=> $this->Resolution,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.resolution')->extends('layouts.head');
    }
}
