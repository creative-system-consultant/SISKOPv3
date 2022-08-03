<?php

namespace App\Http\Livewire\Page\Financing;

use App\Http\Livewire\Page\Admin\Customer\CustomerCoop;
use Livewire\Component;

use App\Models\AccountMaster;
use App\Models\AccountProduct;
use App\Models\Address;
use App\Models\Customer;
use App\Models\CustFamily;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefState;
use App\Models\Ref\RefRelationship;

class Apply_Financing extends Component
{
    public AccountMaster $account;
    public AccountProduct $product;
    public $numpage = 1;
    public Customer $Customer;
    public Address $CustAddress;
    public CustFamily $Family;
    public Address $FamilyAddress;
    public Customer $CustFamily;
    // public CustEmployer $Employer;
    // public Address $CustEmployer;
    public $title;
    public $education;
    public $gender;
    public $marital;
    public $race;
    public $state;
    public $relationship;
    public $birthdate;
    
    protected $rules= [
        'Customer.name'                 => 'required',
        'Customer.icno'                 => 'required',
        'Customer.birthdate'            => 'required',
        'Customer.mobile_num'           => 'required',
        'CustAddress.address1'          => 'required',
        'CustAddress.address2'          => 'required',
        'CustAddress.address3'          => 'nullable',
        'CustAddress.town'              => 'required',
        'CustAddress.postcode'          => 'required',
        'CustAddress.def_state_id'      => 'required',
        'Customer.email'                => 'required',
        'Customer.title_id'             => 'required',
        'Customer.education_id'         => 'required',
        'Customer.gender_id'            => 'required',
        'Customer.marital_id'           => 'required',
        'Customer.race_id'              => 'required',
        'CustFamily.name'               => 'required',
        'Family.relationship_id'        => 'required',
        'CustFamily.icno'               => 'required',
        'CustFamily.mobile_num'         => 'required',
        'FamilyAddress.address1'        => 'required',
        'FamilyAddress.address2'        => 'required',
        'FamilyAddress.address3'        => 'nullable',
        'FamilyAddress.town'            => 'required',
        'FamilyAddress.postcode'        => 'required',
        'FamilyAddress.def_state_id'    => 'required',
    ];

    public function next()
    {
        if($this->numpage < 5 ){
            $this->numpage++;
        }
    }

    public function back()
    {
        if($this->numpage > 0 ){
            $this->numpage--;
        }
    }

    public function mount($product_id)
    {
        $user = Auth()->user();

        $this->Customer         = Customer::where('icno', $user->icno)->first();
        $this->account          = AccountMaster::firstOrCreate([
            'cust_id'       => $this->Customer->id,
            'coop_id'       => $user->coop_id,
            'product_id'    => $product_id,
        ]);
        $this->product          = AccountProduct::find($product_id);
        $this->CustAddress      = $this->Customer->Address()->firstorCreate();
        $this->Family           = CustFamily::firstorCreate(['cust_id' => $this->Customer->id],['relationship_id' => 0]);
        $this->FamilyAddress    = $this->Family->Address()->firstorCreate();
        //$this->CustFamily       = Customer::firstorCreate(['id' => $this->Family->Customer->id]);
        // $this->Employer         = CustEmployer::firstorCreate(['cust_id' => $this->Customer->id]);
        // $this->EmployerAddress  = $this->Employer->Address()->firstorCreate();
        $this->title            = RefCustTitle::all();
        $this->education        = RefEducation::all();
        $this->gender           = RefGender::all();
        $this->marital          = RefMarital::all();
        $this->race             = RefRace::all();
        $this->state            = RefState::all();
        $this->relationship     = RefRelationship::all();
    }

    public function submit()
    {
        
        // dd($this->Customer->id, $this->Customer->coop_id);
        // dd($this->Customer,$this->CustFamily);
        $this->validate();

        $this->Customer->save();
        $this->Customer->birthdate = $this->birthdate;
        $this->Family->save();
        // $this->Employer->save();

        $this->Customer->Address()->save($this->CustAddress);
        $this->Family->Address()->save($this->FamilyAddress);
        // $this->Employer->Address()->save($this->EmployerAddress);

        $this->CustFamily->Update([

            'name'          => $this->CustFamily['name'],
            'icno'          => $this->CustFamily['icno'],
            'email'         => $this->CustFamily['email'],
            'mobile_num'    => $this->CustFamily['mobile_num'],
        ]);

        // $this->master = AccountMaster::create([
        //     'cust_id'         => $this->Customer->id,
        //     'coop_id'         => $this->Customer->coop_id,
        //     'mbr_no'          => '011',
        //     'account_no'          => '01',
        //     'product_id'          => '1',
        //     'profit_rate'          => '8.8',
        //     'account_status'          => '1',
        //     'purchase_price'          => '100',
        //     'selling_price'          => '150',
        //     'approved_limit'          => '100',
        //     'instal_amount'          => '50',
        //     'created_at'      => now(),
        //     'created_by'      => Auth()->user()->name,
        // ]);

        session()->flash('message', 'Apply Being Processed');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');

    }

    public function render()
    {
        return view('livewire.page.financing.apply-financing')->extends('layouts.head');
    }
}