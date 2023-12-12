<?php

namespace App\Http\Livewire\Page\Executive\Approval\BuyShare;

use App\Models\Share;
use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class Committee extends Component
{
    public User $User;
    public Approval $Approval;
    public Share $Committee;
    public $banks;
    public $approval_type = 'lulus';
    public $message = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'        => ['required','max:255'],
        'Committee.approved_amt' => 'required',
        'Committee.bank_code' => 'required',
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
    }

    public function countVote(){
        //checks if vote unanimous is checked true, and votes are contradictory
        if ($this->Committee->current_approval()->rule_vote && $this->Committee->approval_vote_yes() > 0 && $this->Committee->approval_vote_no() > 0){
            $this->Committee->step++;
        }

        //else, check if all votes are casted
        else if ($this->Committee->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            if($this->Committee->approval_vote_yes() > $this->Committee->approval_vote_no()){
                $this->Committee->step++;
            } else {
                $this->Committee->step++;
                $this->message = 'Application reccomended to declined';
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

        $this->Committee->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->Committee->step > 1){
            $this->Committee->step--;
            $this->Committee->save();

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
        $this->Committee = Share::where('uuid', $uuid)->with('customer')->first();
        $this->banks    = RefBank::where('client_id', $this->Committee->client_id)->where('status', '1')->orderby('priority','asc')->orderby('description')->get();
        $this->Approval = Approval::where([
            ['approval_id', $this->Committee->id],
            ['order', $this->Committee->step],
            ['user_id', $this->User->id],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
    }

    public function deb(){
        dd([
            'Share'    => $this->Committee,
            'Approval' => $this->Approval,
            'vote'   => $this->Committee->current_approval()->rule_vote,
            'yes'    => $this->Committee->approval_vote_yes(),
            'no'     => $this->Committee->approval_vote_no(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-committee')->extends('layouts.head');
    }
}
