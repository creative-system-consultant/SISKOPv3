<?php

namespace App\Http\Livewire\Page\Executive\Approval\BuyShare;

use App\Models\Share;
use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class Approver extends Component
{
    public User $User;
    public Approval $Approval;
    public Share $Approver;
    public $bank;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'        => ['required','max:255'],
        'Approver.approved_amt' => 'required',
    ];

    public function decline() {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
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

    public function doApprove(){
        $this->Approver->flag = 20;
        $num = $this->User->id;
        $newnum = date('y').str_pad($this->User->client_id,3,'0',STR_PAD_LEFT).str_pad($num,6,'0',STR_PAD_LEFT);
        $this->Approver->Customer->ref_no = $newnum;
        $this->Approver->Customer->save();
        $this->message = 'Application Approved';
    }

    public function doFail(){
        $this->Approver->flag = 24;
        $this->message = 'Application Rejected';
    }

    public function countVote(){
        //checks if vote unanimous is checked true, and votes are contradictory
        if ($this->Approver->current_approval()->rule_vote_type == 'unanimous' && $this->Approver->approval_vote_yes() > 0 && $this->Approver->approval_vote_no() > 0){
            $this->Approver->step++;
        }
        else if ($this->Approver->current_approval()->rule_vote_type == 'absolute_approve' && $this->Approver->approval_vote_yes() > 0){
            $this->doApprove();
        }
        else if ($this->Approver->current_approval()->rule_vote_type == 'absolute_decline' && $this->Approver->approval_vote_no() > 0){
            $this->doApprove();
        }
        //else, check if all votes are casted
        else if ($this->Approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            if($this->Approver->approval_vote_yes() > $this->Approver->approval_vote_no()){
                $this->doApprove();
            } else {
                $this->doFail();
            }

            $this->doApproval();
        }
    }

    public function next()
    {
        $this->validate();

        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = $this->approval_type;
        $this->Approval->save();

        $this->countVote();

        $this->Approver->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->Approver->step > 1){
            $this->Approver->step--;
            $this->Approver->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');
            session()->flash('time', 10000);

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
        $this->Approver = Share::where('uuid', $uuid)->with('customer')->first();
        $this->bank     = RefBank::where('code', $this->Approver->bank_code)->first()->description;
        $this->Approval = Approval::where([
            ['approval_id', $this->Approver->id],
            ['order', $this->Approver->step],
            ['user_id', $this->User->id],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
    }

    public function deb(){
        dd([
            'Share'    => $this->Approver,
            'Approval' => $this->Approval,
            'vote'   => $this->Approver->current_approval()->rule_vote,
            'yes'    => $this->Approver->approval_vote_yes(),
            'no'     => $this->Approver->approval_vote_no(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-approver')->extends('layouts.head');
    }
}
