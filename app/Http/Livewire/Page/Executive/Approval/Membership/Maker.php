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

class Maker extends Component
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
    public $Approval;

    public $banks;
    public $client_id;
    public $educationlist;
    public $genderlist;
    public $maritallist;
    public $racelist;
    public $relationshiplist;
    public $statelist;

    public $input_disable = 'readonly';
    public $input_maker = '';

    protected $rules = [
        'Approval.note'                    => ['required','max:255'],
        'Application.total_fee'            => ['nullable'],
        'Application.total_monthly'        => ['nullable'],
        'Application.share_fee'            => ['required','gte:0'],
        'Application.share_monthly'        => ['required','gte:0'],
        'Application.register_fee'         => ['required','gte:0'],
        'Application.contribution_monthly' => ['required','gte:0'],
        'Application.contribution_fee'     => ['required','gte:0'],
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

    public function decline(){
        //
    }

    public function next()
    {
        $this->validate();
        $this->Application->step++;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp){
            //$this->Application->sendWS('SISKOPv3 Membership Application ('.$this->Application->coop->name.') have been pre-approved by MAKER');
        }

        if ($this->Approval->rule_sms){
            //$this->Application->sendSMS('RM0 SISKOPv3 Membership Application ('.$this->Application->coop->name.') have been pre-approved by MAKER');
        }

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list',['page' => '1']);
    }

    public function totalfee()
    {
        if ($this->Application->share_pmt_mode_flag == 1){
            //$this->Application->share_monthly = 0;
            //$this->Application->share_lump_sum_amt = $this->Application->share_fee;
        } else {
            //$this->Application->share_monthly = $this->Application->share_fee;
            //$this->Application->share_lump_sum_amt = 0;
        }

        $this->Application->total_fee = $this->Application->register_fee  + $this->Application->share_fee + $this->Application->contribution_fee;
        
        $this->Application->total_monthly = $this->Application->share_monthly + $this->Application->contribution_monthly;

    }

    public function mount($uuid)
    {
        $this->Application = ApplyMembership::where('uuid', $uuid)->first();
        $this->User     = User::find(auth()->user()->id);
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
                            ['approval_id', $this->Application->id],
                            ['order', $this->Application->step],
                            ['role_id', '1'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->where(function ($query){
                            $query->where('user_id', NULL)
                            ->orWhere('user_id', $this->User->id);
                        })->first();
        if ($this->Approval == NULL){
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');
            session()->flash('time', 10000);

            return redirect()->route('application.list',['page' => '1']);
        } else {
            $this->Approval->user_id = $this->User->id;
            $this->Approval->save();
        }
        $this->CustAddress = Address::where([
                            ['cif_id', $this->Cust->id ],
                            ['address_type_id', 2],
                            ['client_id', $this->client_id],
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

        if($this->Application->share_fee >= 500){
            //$this->Application->share_monthly = 0;
            //$this->Application->save();
        }
        if ($this->Application->share_pmt_mode_flag == 1){
            //$this->Application->share_monthly = 0;
            //$this->Application->share_fee = $this->Application->share_lump_sum_amt;
        } else {
            //$this->Application->share_fee = $this->Application->share_monthly;
            //$this->Application->share_lump_sum_amt = 0;
        }
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.maker')->extends('layouts.head');
    }
}
