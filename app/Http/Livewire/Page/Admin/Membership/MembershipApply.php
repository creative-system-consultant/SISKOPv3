<?php

namespace App\Http\Livewire\Page\Admin\Membership;

use App\Models\Address;
use App\Models\ApplyMembership;
use App\Models\Customer;
use App\Models\CustEmployer;
use App\Models\CustFamily;
use App\Models\Membership;
use App\Models\MembershipField;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefState;
use Livewire\Component;

class MembershipApply extends Component
{
    public Membership $member;
    public ApplyMembership $applymember;
    public Customer $Cust;
    public Customer $CustFamily;
    // public CustFamily $Family;
    public CustEmployer $Employer;
    public Address $CustAddress;
    public Address $EmployAddress;
    public Address $FamilyAddress;
    public $birthdate;
    public $field;
    public $title_id;
    public $education_id;
    public $gender_id;
    public $marital_id;
    public $relationship;
    public $race_id;
    public $state_id;
    public $name;
    public $icno;
    public $numpage = 1;

    protected $rules = [
        'Cust.name'                   => 'required',
        'Cust.icno'                   => 'required',
        'Cust.mobile_num'             => 'required',
        'Cust.birthdate'              => 'required',
        'Cust.race_id'                => 'required',
        'Cust.gender_id'              => 'required',
        'Cust.education_id'           => 'required',
        'Cust.marital_id'             => 'required',
        'Cust.email'                  => 'required',
        'Cust.title_id'               => 'required',
        'CustAddress.address1'        => 'required',
        'CustAddress.address2'        => 'required',
        'CustAddress.address3'        => 'nullable',
        'CustAddress.postcode'        => 'required',
        'CustAddress.town'            => 'required',
        'CustAddress.def_state_id'    => 'required',
        'Employer.name'               => 'required',
        'Employer.department'         => 'required',
        'Employer.position'           => 'required',
        'Employer.office_num'         => 'required',
        'Employer.salary'             => 'required',
        'Employer.worker_num'         => 'required',
        'EmployAddress.address1'      => 'required',
        'EmployAddress.address2'      => 'required',
        'EmployAddress.address3'      => 'nullable',
        'EmployAddress.postcode'      => 'required',
        'EmployAddress.town'          => 'required',
        'EmployAddress.def_state_id'  => 'required',
        'FamilyAddress.address1'      => 'required',
        'FamilyAddress.address2'      => 'required',
        'FamilyAddress.address3'      => 'nullable',
        'FamilyAddress.postcode'      => 'required',
        'FamilyAddress.town'          => 'required',
        'FamilyAddress.def_state_id'  => 'required',
        'Family.relationship_id'      => 'required',
        'CustFamily.name'             => 'required',
        'CustFamily.icno'             => 'required',
        'CustFamily.email'            => 'required',
        'CustFamily.mobile_num'       => 'required',
    ];
        
    public function next()
    {
        if ($this->numpage < 2){
            $this->numpage++;
        }
    }
        
    public function back()
    {
        if ($this->numpage > 0){
            $this->numpage--;
        }
    }
    public function mount()
    {
        $user = auth()->user();
        $this->member            = Membership::where('coop_id', $user->coop_id)->first();
        $this->Cust              = Customer::where([['icno', $user->icno],['coop_id', $user->coop_id]])->first();
        $this->CustAddress       = $this->Cust->Address()->firstOrCreate();
        // $this->Family            = Customer::where([['icno', $user->icno],['coop_id', $user->coop_id]])->first();
        $this->Family            = CustFamily::firstOrCreate(['cust_id' => $this->Cust->id],['relationship_id' => 0]);
        $this->FamilyAddress     = $this->Family->Address()->firstOrCreate();
        // $this->CustFamily        = $this->Cust->customer()->firstOrCreate();
        $this->applymember       = ApplyMembership::firstOrCreate(['cust_id' => $this->Cust->id, 'coop_id' =>$user->coop_id],);
        $this->Employer          = CustEmployer::firstOrCreate(['cust_id' => $this->Cust->id],);
        $this->EmployAddress     = $this->Employer->Address()->firstOrCreate();
        $this->field             = MembershipField::where('membership_id', $this->member->id)->get();
        $this->title_id          = RefCustTitle::all();
        $this->education_id      = RefEducation::all();
        $this->gender_id         = RefGender::all();
        $this->marital_id        = RefMarital::all();
        $this->relationship      = RefRelationship::all();
        $this->race_id           = RefRace::all();
        $this->state_id          = RefState::all();
        $this->birthdate         = $this->Cust->birthdate->format('Y-m-d');
    }


    public function submit()
    {
        $user = auth()->user();
        $this->validate();
        $this->Cust->birthdate = $this->birthdate;
        $this->Cust->save();
        $this->Employer->save();
        $this->Family->save();

        $this->Cust->address()->save($this->CustAddress);
        $this->Employer->address()->save($this->EmployAddress);
        $this->Family->address()->save($this->FamilyAddress);
        // $this->Family->customer()->save($this->CustFamily);

        //cara 1
        // $this->applymember->flag  = 1;
        // $this->applymember->step  = 1;
        // $this->applymember->save();
        //cara 2
        $this->applymember->update([
            'flag' => 1,
            'step' => 1,
        ]);

        session()->flash('message', 'Membership Application Registered');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }
    
    public function render()
    {
        return view('livewire.page.admin.membership.membership-apply')->extends('layouts.head');
    }
    
}