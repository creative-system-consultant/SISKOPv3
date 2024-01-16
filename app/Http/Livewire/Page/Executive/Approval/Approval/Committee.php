<?php

namespace App\Http\Livewire\Page\Executive\Approval\Approval;

use App\Models\ApplyDividend;
use App\Models\ApplySpecialAid;
use App\Models\Approval;
use App\Models\CloseMembership;
use App\Models\Contribution;
use App\Models\Share;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class Committee extends Component
{
    public User $User;
    public $Approval;
    public $Application;

    public $approval_type = 'lulus';
    public $banks = [];
    public $disable = 'readonly';
    public $forward = false;
    public $include = '';
    public $message = 'Application Voted Approve';
    public $page = 0;
    public $pagename = '';
    public $pagetype = '';
    public $vote = 'Vote';

    protected function rules()
    {
        $rules = [
            'Approval.note' => 'required|max:255',
        ];

        return array_merge($rules, $this->custom_rule[$this->include]['rule']);
    }

    protected $custom_rule = [
        'share' => [
            'name' => 'Add Share',
            'type' => 'App\Models\Share',
            'page' => 2,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.bank_code' => 'required',
            ],
        ],
        'sellshare' => [
            'name' => 'Sell Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'exchangeshare' => [
            'name' => 'Exchange Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                //'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'contribution' => [
            'name' => 'Add Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 4,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'sellcontribution' => [
            'name' => 'Withdrawal Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 5,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'dividen' => [
            'name' => 'Dividend',
            'type' => 'App\Models\ApplyDividend',
            'page' => 10,
            'rule' => [
                'Application.div_cash_approved' => 'required|gt:0',
                'Application.div_share_approved' => 'required|gt:0',
                'Application.div_contri_approved' => 'required|gt:0',
            ],
        ],
        'closemembership' => [
            'name' => 'Close Membership',
            'type' => 'App\Models\CloseMembership',
            'page' => 8,
            'rule' => [
                //'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'specialaid' => [
            'name' => 'Special Aid',
            'type' => 'App\Models\ApplySpecialAid',
            'page' => 6,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0|numeric',
            ],
        ],
    ];

    public function forward()
    {
        $this->validate();
        $this->approval_type = 'Send to next level';
        $this->message       = 'Application send to next level';
        $this->next();
    }

    public function decline()
    {
        $this->validate();
        $this->approval_type = 'gagal';
        $this->message       = 'Application Voted decline';
        $this->next();
    }

    public function countVote()
    {
        //checks if vote unanimous is true, and votes are contradictory
        if ($this->Application->current_approval()->rule_vote_type == 'unanimous' && $this->Application->approval_vote_yes() > 0 && $this->Application->approval_vote_no() > 0) {
            $this->Application->step++;
        }

        //checks if vote absolute is true, and votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_approve' && $this->Application->approval_vote_yes() > 0) {
            $this->Application->step++;
        }

        //checks if vote absolute is true, and votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_decline' && $this->Application->approval_vote_no() > 0) {
            $this->Application->step++;
        }

        //checks if vote majority is true
        else if (
            $this->Application->current_approval()->rule_vote_type == 'majority'
            && $this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0
        ) {
            $this->Application->step++;
        }

        //else, check if all votes are casted
        else if ($this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0) {
            $this->Application->step++;
            //$this->doApproval();
        }
    }

    public function next()
    {
        $this->validate();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = $this->approval_type;
        $this->Approval->save();

        $this->countVote();
        $this->Application->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
    }

    public function back()
    {
        if ($this->Application->step > 1) {
            $this->Application->step--;
            $this->Application->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');
            session()->flash('time', 10000);

            return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
        } else {
            $this->dispatchBrowserEvent('swal', [
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
            'Approval' => $this->Approval,
            'Application' => $this->Application,
            'rules' => $this->rules(),
            'include' => $this->custom_rule[$this->include]['rule'],
        ]);
    }

    public function notfound()
    {
        session()->flash('message', 'Application does not exist');
        session()->flash('warning');
        session()->flash('time', 10000);
        session()->flash('title', 'Warning!');
    }

    public function mount($uuid, $include)
    {
        if (!in_array($include, ['share', 'sellshare', 'contribution', 'sellcontribution', 'closemembership', 'specialaid', 'dividend'])){
            $this->notfound();
            return redirect()->route('application.list');
        }
        $this->include  = $include;
        $this->page     = $this->custom_rule[$this->include]['page'] ?? '';
        $this->pagename = $this->custom_rule[$this->include]['name'] ?? '';
        $this->pagetype = $this->custom_rule[$this->include]['type'] ?? '';
        $this->User     = User::find(auth()->user()->id);

        if ($this->include == 'contribution' || $this->include == 'sellcontribution') {
            $this->Application = Contribution::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'share' || $this->include == 'sellshare' || $this->include == 'exchangeshare') {
            $this->Application = Share::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'closemembership') {
            $this->Application = CloseMembership::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'dividend') {
            $this->Application = ApplyDividend::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'specialaid') {
            $this->Application = ApplySpecialAid::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else {
            $this->notfound();
            return redirect()->route('application.list', ['page' => 1]);
        }

        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '3'],
            ['user_id', $this->User->id],
            ['approval_type', $this->pagetype],
        ])->first();
        if ($this->Approval == NULL) {
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        } else if ($this->Approval->vote != NULL) {
            session()->flash('message', 'Application is have been processed by you');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        }
        $this->forward = $this->Approval->rule_forward ?? FALSE;
        $this->banks = RefBank::where('client_id', $this->Application->client_id)->where('status', '1')->orderby('priority', 'asc')->orderby('description')->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.approval.approval')->extends('layouts.head');

        // @include('livewire.page.executive.approval.approval.contribution')
        // @include('livewire.page.executive.approval.approval.sellcontribution')
        // @include('livewire.page.executive.approval.approval.dividend')
        // @include('livewire.page.executive.approval.approval.share')
        // @include('livewire.page.executive.approval.approval.sellshare')
        // @include('livewire.page.executive.approval.approval.exchangeshare')
        // @include('livewire.page.executive.approval.approval.closemembership')
    }
}
