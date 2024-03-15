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

class Checker extends Component
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
    public $uuid;

    // untuk selesai masalah hydration dropdown, sebab code lama amik data direct dari db.
    public $share_pmt_mode_flag;
    public $payment_type;
    public $contribution_fee_monthly;
    public $share_fee_monthly;
    public $total_monthly;
    public $total_fee;

    public $forward       = false;
    public $input_disable = 'readonly';
    public $input_maker   = 'readonly';
    public $approval_type = 'lulus';
    public $message       = 'Application Pre-Approved';

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
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {
        $this->validate();
        $this->Application->step++;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        if ($this->Approval->rule_whatsapp) {
        }

        if ($this->Approval->rule_sms) {
        }

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list', ['page' => '1']);
    }

    public function totalfee()
    {
        $this->Application->update([
            'total_fee'     => $this->Application->register_fee  + $this->Application->contribution_fee    + $this->Application->share_fee,
            'total_monthly' => $this->Application->share_monthly + $this->Application->contribution_monthly,
        ]);
    }

    public function cancel()
    {
    }

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->User     = User::find(auth()->user()->id);
        $this->Application  = ApplyMembership::where('uuid', $uuid)->first();
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '2'],
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
        $this->forward  = $this->Approval->rule_forward ?? FALSE;
        $this->CustAddress = Address::where([
            ['cif_id', $this->Cust->id],
            ['address_type_id', 'N'],
            ['client_id', $this->client_id],
            ['apply_id', $this->Application->id],
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

        return view('livewire.page.executive.approval.membership.checker')->extends('layouts.head');
    }
}
