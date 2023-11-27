<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use DB;
use Livewire\Component;

class Approver extends Component
{
    public User $User;
    public Approval $Approval;
    public $Approver;
    public $banks;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'     => 'required',
        'Approver.share_fee'       => ['required','gt:0'],
        'Approver.share_monthly'   => ['required','gt:0'],
        'Approver.register_fee'    => ['required','gt:0'],
        'Approver.contribution_fee'=> ['required','gt:0'],
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

        $ret = DB::table('ref.user_has_clients')->insert([
            'user_id'   => $this->Approver->user_id,
            'client_id' => $this->User->client_id,
        ]);

        // put event to Stored Proc
        // put event here
    }

    public function countVote(){
        //checks if vote unanimous is checked true, and votes are contradictory
        if ($this->Approver->current_approval()->rule_vote && $this->Approver->approval_vote_yes() > 0 && $this->Approver->approval_vote_no() > 0){
            $this->Approver->step++;
        }

        //else, check if all votes are casted
        else if ($this->Approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            if($this->Approver->approval_vote_yes() > $this->Approver->approval_vote_no()){
                $this->Approver->flag = 20;
                $num = $this->User->id;
                $newnum = date('y').str_pad($this->User->client_id,3,'0',STR_PAD_LEFT).str_pad($num,6,'0',STR_PAD_LEFT);
                //$this->Approver->Customer->ref_no = $newnum;
                $this->Approver->Customer->save();
                $this->Approver->mbr_no = $newnum;
                $this->message = 'Application Approved';
            } else {
                $this->Approver->account_status = 24;
                $this->message = 'Application Rejected';
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
        $this->Approver = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                        ['approval_id', $this->Approver->id],
                        ['order', $this->Approver->step],
                        ['user_id', $this->User->id],
                        ['approval_type', 'App\Models\ApplyMembership'],
                    ])->firstOrFail();
    }

    public function deb(){
        dd([
            'Member' => $this->Approver,
            'Approval' => $this->Approval,
            'vote'   => $this->Approver->current_approval()->rule_vote,
            'yes'    => $this->Approver->approval_vote_yes(),
            'no'     => $this->Approver->approval_vote_no(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.approver')->extends('layouts.head');
    }
}
