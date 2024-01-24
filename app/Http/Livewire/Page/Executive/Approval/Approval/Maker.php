<?php

namespace App\Http\Livewire\Page\Executive\Approval\Approval;

use App\Models\ApplyDividend;
use App\Models\ApplySpecialAid;
use App\Models\Approval;
use App\Models\ChangeGuarantor;
use App\Models\CloseMembership;
use App\Models\Contribution;
use App\Models\FmsGlobalParm;
use App\Models\Share;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class Maker extends Component
{
    public User $User;
    public $Approval;
    public $Application;

    public $approval_type = 'lulus';
    public $banks = [];
    public $disable = '';
    public $forward = false;
    public $include = '';
    public $message = 'Application Pre-Approved';
    public $page = 0;
    public $pagename = '';
    public $pagetype = '';
    public $vote = 'Suggest';

    public $globalParm;
    public $client_bank_id;
    public $client_bank_name;
    public $client_bank_acct;

    protected function rules()
    {
        $rules = [
            'Approval.note' => 'required|max:255',
            'client_bank_name' => 'nullable',
            'client_bank_acct' => 'nullable',
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
                'Application.cheque_clear' => 'required_if:Application.method,==,cheque|after:Application.cheque_date',
            ],
        ],
        'sellshare' => [
            'name' => 'Sell Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.bank_code' => 'required',
            ],
        ],
        'exchangeshare' => [
            'name' => 'Transfer Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'contribution' => [
            'name' => 'Add Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 4,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.start_approved' => 'after_or_equal:Application.start_apply',
                'Application.cheque_clear' => 'required|after:Application.cheque_date',
            ],
        ],
        'sellcontribution' => [
            'name' => 'Withdrawal Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 5,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.apply_amt' => 'required|gt:0',
            ],
        ],
        'dividend' => [
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
        'ChangeGuarantor' => [
            'name' => 'Change Guarantor',
            'type' => 'App\Models\ChangeGuarantor',
            'page' => 10,
            'rule' => [],
        ],
    ];

    public function xvalidate(){
        //ni solution en nasir. aku taknak argue
        if ($this->include == 'share' || $this->include == 'contribution'){
            if($this->Application->method != 'cheque'){
                $this->Application->cheque_date = date('Y-m-d', strtotime('today'));
                $this->Application->cheque_clear = date('Y-m-d', strtotime("tomorrow"));
            }
            if ($this->include == 'contribution' && $this->Application->start_apply == NULL){
                $this->Application->start_apply = date('Y-m-d', strtotime('today'));
                $this->Application->start_approved = date('Y-m-d', strtotime('today'));
            }
        }
        $this->validate();
        if ($this->include == 'share' || $this->include == 'contribution'){
            if($this->Application->method != 'cheque'){
                $this->reset($this->Application->cheque_date);
                $this->Application->cheque_clear = NULL;
            }
            if ($this->include == 'contribution' && $this->Application->start_apply == NULL){
                $this->Application->start_apply = NULL;
                $this->Application->start_approved = NULL;
            }
        }
    }

    public function decline()
    {
        $this->xvalidate();

        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {
        $this->xvalidate();

        $this->Application->step++;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
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
        session()->flash('message', 'Application don\'t exist');
        session()->flash('warning');
        session()->flash('time', 10000);
        session()->flash('title', 'Warning!');
    }

    public function mount($uuid, $include)
    {
        if (!in_array($include, ['share', 'sellshare', 'exchangeshare', 'contribution', 'sellcontribution', 'closemembership', 'specialaid', 'dividend', 'ChangeGuarantor'])) {
            $this->notfound();
            return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
        }
        $this->include  = $include;
        $this->page     = $this->custom_rule[$this->include]['page'];
        $this->pagename = $this->custom_rule[$this->include]['name'];
        $this->pagetype = $this->custom_rule[$this->include]['type'] ?? '';
        $this->User     = User::find(auth()->user()->id);

        if ($this->include == 'contribution' || $this->include == 'sellcontribution') {
            $this->Application = Contribution::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->apply_amt ?? $this->Application->approved_amt;
        } else if ($this->include == 'share' || $this->include == 'sellshare' || $this->include == 'exchangeshare') {
            $this->Application = Share::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->apply_amt ?? $this->Application->approved_amt;
        } else if ($this->include == 'closemembership') {
            $this->Application = CloseMembership::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'dividend') {
            $this->Application = ApplyDividend::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'specialaid') {
            $this->Application = ApplySpecialAid::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'ChangeGuarantor') {
            $this->Application = ChangeGuarantor::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else {
            $this->notfound();
            return redirect()->route('application.list', ['page' => 1]);
        }

        if ($this->Application == NULL) {
            $this->notfound();
            return redirect()->route('application.list', ['page' => 1]);
        }

        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '1'],
            ['approval_type', $this->pagetype],
        ])->where(function ($query) {
            $query->where('user_id', NULL)
                ->orWhere('user_id', $this->User->id);
        })->first();

        if ($this->Approval == NULL) {
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        } else {
            $this->Approval->user_id = $this->User->id;
            $this->Approval->save();
        }
        $this->banks = RefBank::where('client_id', $this->Application->client_id)->where('status', '1')->orderby('priority', 'asc')->orderby('description')->get();

        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
        $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
        $this->client_bank_name = $bank_name->description;
        $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;

        if ($this->include == 'share' || $this->include == 'contribution'){
            if ($this->Application->method == 'cheque'){
                $this->Application->cheque_clear = $this->Application->cheque_clear?->format('Y-m-d') ?? $this->Application->cheque_date->format('Y-m-d');
            }
        }
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
