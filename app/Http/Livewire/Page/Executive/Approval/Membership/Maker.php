<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\Customer as FMSCustomer;
use App\Models\FmsGlobalParm;
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

    public $uuid;
    public $banks;
    public $client_id;
    public $educationlist;
    public $genderlist;
    public $maritallist;
    public $racelist;
    public $relationshiplist;
    public $statelist;
    public $globalParm;
    public $minShare;
    public $minShareMonthly;

    // untuk selesai masalah hydration dropdown, sebab code lama amik data direct dari db.
    public $share_pmt_mode_flag;
    public $payment_type;
    public $contribution_fee_monthly;
    public $share_fee_monthly;
    public $total_monthly;
    public $total_fee;

    public $input_disable = 'readonly';
    public $input_maker = '';

    protected $rules = [
        'Approval.note'                    => ['required', 'max:255'],
        'Application.total_fee'            => ['nullable'],
        'Application.total_monthly'        => ['nullable'],
        'Application.share_fee'            => ['required', 'gte:0'],
        'Application.share_monthly'        => ['required', 'gte:0'],
        'Application.register_fee'         => ['required', 'gte:0'],
        'Application.contribution_monthly' => ['required', 'gte:0'],
        'Application.contribution_fee'     => ['required', 'gte:0'],
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

    public function decline()
    {
        $this->Application->step++;
        $this->Application->save();

        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'gagal';
        $this->Approval->save();


        session()->flash('message', 'Application is recommended to declined');
        session()->flash('error');
        session()->flash('title', 'Pending!');
        session()->flash('time', 10000);

        return redirect()->route('application.list', ['page' => '1']);
    }

    public function next()
    {
        $this->validate();
        $this->Application->step++;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();


        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list', ['page' => '1']);
    }

    public function totalfee()
    {
        if ($this->share_pmt_mode_flag == 1) {
            $this->Application->contribution_monthly = $this->contribution_fee_monthly;
            $this->Application->share_monthly = 0;
            $this->Application->share_lump_sum_amt = $this->minShare;
            $this->share_fee_monthly = number_format($this->minShare, 2);
            $this->total_monthly = number_format($this->contribution_fee_monthly, 2);
        } else {
            $this->Application->contribution_monthly = $this->contribution_fee_monthly;
            $this->Application->share_monthly = $this->share_fee_monthly;
            $this->total_monthly = number_format($this->share_fee_monthly + $this->contribution_fee_monthly, 2);
        }


        $this->total_fee = number_format($this->contribution_fee_monthly + $this->Application->register_fee + $this->share_fee_monthly, 2);
        $this->Application->total_fee = $this->total_fee;


        $this->Application->total_monthly = $this->total_monthly;
        $this->Application->share_pmt_mode_flag = $this->share_pmt_mode_flag;
        $this->Application->payment_type = $this->payment_type;
        $this->Application->save();
    }

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->Application = ApplyMembership::where('uuid', $uuid)->first();
        $this->User     = User::find(auth()->user()->id);
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '1'],
            ['approval_type', 'App\Models\ApplyMembership'],
        ])->where(function ($query) {
            $query->where('user_id', NULL)
                ->orWhere('user_id', $this->User->id);
        })->first();

        if ($this->Approval == NULL) {
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');
            session()->flash('time', 10000);

            return redirect()->route('application.list', ['page' => '1']);
        } else {
            $this->Approval->user_id = $this->User->id;
            $this->Approval->save();
        }

        $this->CustAddress = Address::where([
            ['cif_id', $this->Cust->id],
            ['address_type_id', 'N'],
            ['client_id', $this->client_id],
        ])->first();

        $this->EmployAddress = Address::where([
            ['cif_id', $this->Cust->id],
            ['address_type_id', 'B'],
            ['client_id', $this->client_id],
            ['apply_id', $this->Application->id],
        ])->first();

        $this->CustFamily = Family::where([
            ['cif_id', $this->Cust->id],
            ['client_id', $this->client_id],
            ['apply_id', $this->Application->id],
        ])->first();

        $this->Employer   = Employer::where([
            ['cust_id', $this->Cust->id],
            ['client_id', $this->client_id],
            ['apply_id', $this->Application->id],
        ])->first();

        $this->Introducer = Introducer::where([
            ['client_id', $this->client_id],
            ['introduce_type', 'App\Models\SiskopCustomer'],
            ['introduce_id', $this->Cust->id],
            ['apply_id', $this->Application->id],
        ])->first();

        $this->banks            = RefBank::where('client_id', $this->client_id)->get();
        $this->CustIntroducer   = FMSCustomer::firstOrNew(['id' => $this->Introducer->intro_cust_id]);
        $this->statelist        = RefState::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->relationshiplist = RefRelationship::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->educationlist    = RefEducation::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->genderlist       = RefGender::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->maritallist      = RefMarital::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->racelist         = RefRace::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->globalParm       = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->minShare = $this->globalParm->MIN_SHARE;
        $this->minShareMonthly = $this->globalParm->MIN_SHARE / $this->globalParm->TOT_MTH_SHARE_INSTALMENT;


        $this->share_pmt_mode_flag = $this->Application->share_pmt_mode_flag;
        $this->payment_type = $this->Application->payment_type;
        $this->contribution_fee_monthly = $this->Application->contribution_monthly;
        $this->share_fee_monthly = $this->Application->share_monthly;
        $this->total_monthly = $this->Application->total_monthly;
        $this->total_fee = $this->Application->total_fee;
    }

    public function render()
    {
        $this->Application = ApplyMembership::where('uuid', $this->uuid)->first();
        return view('livewire.page.executive.approval.membership.maker')->extends('layouts.head');
    }
}
