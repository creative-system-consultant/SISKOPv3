<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\Customer as FMSCustomer;
use App\Models\SiskopAddress as Address;
use App\Models\SiskopCustomer as Customer;
use App\Models\SiskopFamily as Family;
use App\Models\SiskopEmployer as Employer;
use App\Models\Introducer;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefState;
use App\Models\User;
use Livewire\Component;

class Committee extends Component
{
    public User $User;
    public Address $CustAddress;
    public Address $EmployAddress;
    public Customer $Cust;
    public Employer $Employer;
    public Family $CustFamily;
    public FMSCustomer $CustIntroducer;
    public Introducer $Introducer;
    public ApplyMembership $Application;
    public Approval $Approval;

    public $banks;
    public $client_id;
    public $educationlist;
    public $genderlist;
    public $maritallist;
    public $racelist;
    public $relationshiplist;
    public $statelist;

    public $input_disable = 'readonly';
    public $input_maker   = 'readonly';
    public $approval_type = 'lulus';
    public $message       = 'Application Pre-Approved';

    protected $rules = [
        'Approval.note'                    => ['required','max:255'],
        'Application.total_fee'            => ['nullable'],
        'Application.total_monthly'        => ['nullable'],
        'Application.share_fee'            => ['required','gt:0'],
        'Application.share_monthly'        => ['required','gt:0'],
        'Application.register_fee'         => ['required','gt:0'],
        'Application.contribution_fee'     => ['required','gt:0'],
        'Application.contribution_monthly' => ['required','gt:0'],
        'Application.share_pmt_mode_flag'  => ['required'],
        'Application.share_lump_sum_amt'   => ['required'],
        'Application.payment_type'         => ['required'],
        'Application.client_bank_id'       => ['required'],
        'Application.client_bank_acct_no'  => ['required'],
        'CustAddress.address1'             => ['nullable'],
        'CustAddress.address2'             => ['nullable'],
        'CustAddress.address3'             => ['nullable'],
        'CustAddress.postcode'             => ['nullable'],
        'CustAddress.town'                 => ['nullable'],
        'CustAddress.state_id'             => ['nullable'],
        'CustAddress.mail_flag'            => ['nullable'],
        'EmployAddress.address1'           => ['nullable'],
        'EmployAddress.address2'           => ['nullable'],
        'EmployAddress.address3'           => ['nullable'],
        'EmployAddress.postcode'           => ['nullable'],
        'EmployAddress.town'               => ['nullable'],
        'EmployAddress.state_id'           => ['nullable'],
        'EmployAddress.mail_flag'          => ['nullable'],
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
        //checks if vote unanimous is true, and votes are contradictory
        if ($this->Application->current_approval()->rule_vote_type == 'unanimous' && $this->Application->approval_vote_yes() > 0 && $this->Application->approval_vote_no() > 0){
            $this->Application->step++;
        }

        //checks if vote absolute is true, and votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_approve' && $this->Application->approval_vote_yes() > 0){
            $this->Application->step++;
        }

        //checks if vote absolute is true, and votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_decline' && $this->Application->approval_vote_no() > 0){
            $this->Application->step++;
        }

        //checks if vote majority is true
        else if ($this->Application->current_approval()->rule_vote_type == 'majority' 
              && $this->Application->approvals()->where('type','like','vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0){
            $this->Application->step++;
        }

        //else, check if all votes are casted
        else if ($this->Application->approvals()->where('type','like','vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0){
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
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '1']);
    }

    public function back()
    {
        if ($this->Application->step > 1){
            $this->Application->step--;
            $this->Application->save();

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
        $this->Application  = ApplyMembership::where('uuid', $uuid)->first();
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
                            ['approval_id', $this->Application->id],
                            ['approval_type', 'App\Models\ApplyMembership'],
                            ['order', $this->Application->step],
                            ['role_id', '3'],
                            ['user_id', $this->User->id ],
                        ])->first();
        if($this->Approval == NULL){
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list',['page' => '1']);
        } else if ($this->Approval->vote != NULL){
            session()->flash('message', 'Application is have been processed by you');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list',['page' => '1']);
        }
        $this->CustAddress = Address::where([
                    ['cif_id', $this->Cust->id ],
                    ['address_type_id', 2],
                    ['client_id', $this->client_id],
                    ['apply_id' , $this->Application->id],
                ])->first();
        $this->EmployAddress = Address::where([
                    ['cif_id', $this->Cust->id ],
                    ['address_type_id', 3],
                    ['client_id', $this->client_id],
                    ['apply_id' , $this->Application->id],
                ])->first();
        $this->CustFamily = Family::where([
                    ['cif_id', $this->Cust->id ],
                    ['client_id', $this->client_id],
                    ['apply_id' , $this->Application->id],
                ])->first();
        $this->Employer   = Employer::where([
                    ['cust_id' , $this->Cust->id], 
                    ['client_id' , $this->client_id],
                    ['apply_id' , $this->Application->id],
                ])->first();
        $this->Introducer = Introducer::where([
                    ['client_id' , $this->client_id],
                    ['introduce_type', 'App\Models\SiskopCustomer'],
                    ['introduce_id', $this->Cust->id],
                    ['apply_id' , $this->Application->id],
                ])->first();
        $this->banks            = RefBank::where('client_id', $this->client_id)->get();
        $this->CustIntroducer   = FMSCustomer::firstOrNew(['id' => $this->Introducer->intro_cust_id]);
        $this->statelist        = RefState::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->relationshiplist = RefRelationship::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->educationlist    = RefEducation::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->genderlist       = RefGender::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->maritallist      = RefMarital::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->racelist         = RefRace::where([['client_id', $this->client_id], ['status', '1']])->get();
    }

    public function deb(){
        dd([
            'vote rule' => $this->Application->current_approval()->rule_vote_type,
            'Member' => $this->Application,
            'Approval' => $this->Approval,
            'votes'  => $this->Application->approvals()->where('type','like','vote%')->where('order', $this->Application->step)->whereNull('vote')->count(),
            'yes'    => $this->Application->approval_vote_yes(),
            'no'     => $this->Application->approval_vote_no(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.committee')->extends('layouts.head');
    }
}
