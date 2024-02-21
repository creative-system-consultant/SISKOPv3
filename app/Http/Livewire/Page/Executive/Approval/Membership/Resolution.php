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
use DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Resolution extends Component
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
    public $input_maker   = 'readonly';
    public $approval_type = 'lulus';
    public $message       = 'Application Approved';

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
        // $this->validate();
        $this->Application->flag = 21;
        $this->Application->save();

        $this->approval_type = 'gagal';
        $this->message       = 'Application is declined';

        Log::info("MEMBERSHIP APPROVAL Rejected\nOP = Membership RESOLUTION.");

        $this->next();
    }

    public function doApproval()
    {

        $this->Application->flag = 20;
        $this->Application->approved_date = now();
        $this->Application->save();

        $this->Application->Customer->save();

        $this->message = 'Application Approved';

        // put event to Stored Proc

        $dbname = env('DB_DATABASE', 'fmsv2_dev');
        $spname = $dbname . ".SISKOP.up_insert_customer_fms";
        $result = DB::select("EXEC " . $spname . " ?,?,?", [
            $this->User->client_id,
            $this->Application->id,
            $this->User->id,
        ]);

        if ($result != NULL) {
            if ($result[0]->SP_RETURN_CODE == 0) {
                //check in list of user clients if null adds it.
                $check = DB::table('ref.user_has_clients')->where([['user_id', $this->Application->user_id], ['client_id', $this->Application->client_id]])->get();

                if ($check->count() == 0) {
                    $ret = DB::table('ref.user_has_clients')->insert([
                        'user_id'   => $this->Application->user_id,
                        'client_id' => $this->Application->client_id,
                    ]);
                }

                Log::info("MEMBERSHIP APPROVAL SUCCESS\n SP RETURN = " . json_encode($result));
            } else {
                Log::critical("MEMBERSHIP APPROVAL ERROR\nOP = Membership RESOLUTION.\n ER = SP CALL RETURN ERROR\nSP RETURN = " . json_encode($result));
            }
        } else {
            Log::critical("MEMBERSHIP APPROVAL ERROR\nOP = Membership RESOLUTION.\n ER = SP CALL RETURN ERROR\nSP RETURN = " . json_encode($result));
        }
    }

    public function next()
    {
        $this->validate();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;

        if ($this->approval_type == 'lulus') {
            $this->doApproval();
        }
        $this->Approval->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('title', 'Success!');
        session()->flash('time', 10000);

        return redirect()->route('application.list', ['page' => '1']);
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->Application  = ApplyMembership::where('uuid', $uuid)->first();
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '5'],
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
            ['address_type_id', 3],
            ['client_id', $this->client_id],
            ['apply_id', $this->Application->id],
        ])->first();

        $this->EmployAddress = Address::where([
            ['cif_id', $this->Cust->id],
            ['address_type_id', 2],
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
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.resolution')->extends('layouts.head');
    }
}
