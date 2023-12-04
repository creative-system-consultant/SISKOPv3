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
    public $input_maker   = '';

    protected $rules = [
        'Approval.note'                    => ['required','max:255'],
        'Application.total_fee'            => ['nullable'],
        'Application.total_monthly'        => ['nullable'],
        'Application.share_fee'            => ['required','gt:0'],
        'Application.share_monthly'        => ['required','gt:0'],
        'Application.register_fee'         => ['required','gt:0'],
        'Application.contribution_fee'     => ['required','gt:0'],
        'Application.contribution_monthly' => ['required','gt:0'],
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

    public function totalfee()
    {
        $this->Application->update([
            'total_fee'     => $this->Application->register_fee  + $this->Application->contribution_fee    + $this->Application->share_fee,
            'total_monthly' => $this->Application->share_monthly + $this->Application->contribution_monthly,
        ]);
    }

    public function mount($uuid)
    {
        $this->Application    = ApplyMembership::where('uuid', $uuid)->first();
        $this->User     = User::find(auth()->user()->id);
        $this->Cust     = Customer::where('id', $this->Application->cust_id)->first();
        $this->client_id = $this->User->client_id;
        $this->Approval = Approval::where([
                            ['approval_id', $this->Application->id],
                            ['order', $this->Application->step],
                            ['role_id', '1'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
        $this->CustAddress = Address::where([
                            ['cif_id', $this->Cust->id ],
                            ['address_type_id', 2],
                            ['client_id', $this->client_id],
                        ])->first();
        $this->EmployAddress = Address::where([
                            ['cif_id', $this->Cust->id ],
                            ['address_type_id', 3],
                            ['client_id', $this->client_id],
                        ])->first();
        $this->CustFamily = Family::where([
                            ['cif_id', $this->Cust->id ],
                            ['client_id', $this->client_id],
                        ])->first();
        $this->Employer   = Employer::where([
                            ['cust_id' , $this->Cust->id], 
                            ['client_id' , $this->client_id],
                        ])->first();
        $this->Introducer = Introducer::where([
                            ['client_id' , $this->client_id],
                            ['introduce_type', 'App\Models\SiskopCustomer'],
                            ['introduce_id', $this->Cust->id]
                        ])->first();
        $this->CustIntroducer   = FMSCustomer::firstOrNew(['id' => $this->Introducer->intro_cust_id]);
        $this->statelist        = RefState::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->relationshiplist = RefRelationship::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->educationlist    = RefEducation::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->genderlist       = RefGender::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->maritallist      = RefMarital::where([['client_id', $this->client_id], ['status', '1']])->get();
        $this->racelist         = RefRace::where([['client_id', $this->client_id], ['status', '1']])->get();
    }

    public function deb() {
        dd([
            'roles'     => $this->User->role_ids(),
            'approvals' => $this->Application->approvals,
            'approval'  => $this->Approval, 
            'Application' => $this->Application,
        ]);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.membership.maker')->extends('layouts.head');
    }
}
