<?php

namespace App\Http\Livewire\Page\Application\ApplyFinancing;

use Livewire\Component;

use App\Models\AccountMaster;
use App\Models\AccountProduct;
use App\Models\Address;
use App\Models\Customer;
use App\Models\CustFamily;
use App\Models\CustEmployer;
use App\Models\Introducer;
use App\Models\Guarantor;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefState;
use App\Models\Ref\RefRelationship;

class Apply_Financing extends Component
{
    public AccountMaster $Account;
    public AccountProduct $Product;
    public Customer $Customer;
    public Address $CustAddress;
    public CustFamily $Family;
    public Address $FamilyAddress;
    public Customer $CustFamily;
    public CustEmployer $Employer;
    public Address $EmployerAddress;
    public Customer $Introducer;
    public Customer $Guarantor;
    public $numpage = 1;
    public $name;
    public $icno;
    public $email;
    public $mobile_num;
    public $title;
    public $education;
    public $gender;
    public $marital;
    public $race;
    public $state;
    public $relationship;
    public $birthdate;
    public $search_introducer;
    public $search_guarantor;
    public $mbr_no = [];

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit']; 

    protected $rules= [   
        'Product.name'                     => 'required',
        'Product.profit_rate'              => 'required',
        'Account.purchase_price'           => 'required|numeric|gte:Product.amt_min|lte:Product.amt_max',
        'Account.duration'                 => 'required|gte:Product.term_min|lte:Product.term_max',
        'Customer.name'                    => 'required|string',
        'Customer.icno'                    => 'required',
        'Customer.birthdate'               => 'required',
        'Customer.mobile_num'              => 'required',
        'CustAddress.address1'             => 'required',
        'CustAddress.address2'             => 'required',
        'CustAddress.address3'             => 'nullable',
        'CustAddress.town'                 => 'required',
        'CustAddress.postcode'             => 'required',
        'CustAddress.def_state_id'         => 'required',
        'Customer.email'                   => 'required|email',
        'Customer.title_id'                => 'required',
        'Customer.education_id'            => 'required',
        'Customer.gender_id'               => 'required',
        'Customer.marital_id'              => 'required',
        'Customer.race_id'                 => 'required',
        'Family.relationship_id'           => 'required',
        'CustFamily.name'                  => 'required|string',
        'CustFamily.icno'                  => 'required|numeric|digits:12',
        'CustFamily.mobile_num'            => 'required|numeric',
        'FamilyAddress.address1'           => 'required',
        'FamilyAddress.address2'           => 'required',
        'FamilyAddress.address3'           => 'nullable',
        'FamilyAddress.town'               => 'required',
        'FamilyAddress.postcode'           => 'required',
        'FamilyAddress.def_state_id'       => 'required',
        'Employer.name'                    => 'required|string',
        'Employer.department'              => 'required|string',
        'Employer.position'                => 'required|string',
        'Employer.office_num'              => 'required|numeric',
        'Employer.salary'                  => 'required|numeric',
        'Employer.worker_num'              => 'required|string',
        'EmployerAddress.address1'         => 'required',
        'EmployerAddress.address2'         => 'required',
        'EmployerAddress.address3'         => 'nullable',
        'EmployerAddress.town'             => 'required',
        'EmployerAddress.postcode'         => 'required',
        'EmployerAddress.def_state_id'     => 'required',
        'Introducer.name'                  => 'required',
        'Introducer.icno'                  => 'nullable',
        'Introducer.email'                 => 'nullable',
        'Introducer.mbr_no'                => 'nullable',
        'search_introducer'                => 'required|numeric|digits:12',
        'Guarantor.name'                   => 'required',
        'Guarantor.icno'                   => 'nullable',
        'Guarantor.email'                  => 'nullable',
        'Guarantor.mbr_no'                 => 'nullable',
        'search_guarantor'                 => 'required|numeric|digits:12',
        
    ];

    // protected $messages = [
    //     'Account.purchase_price.gt'        => ':attribute must be more than Product Minimum Financing',  
    //     'Account.duration.gt'              => ':attribute must be more than Minimum Financing Term', 
    //     'Account.duration.lt'              => ':attribute must be less than Maximum Financing Term',
    // ];

    // protected $validationAttributes = [
    //     'Account.purchase_price'    => 'Purchase Price', 
    //     'Account.duration'          => 'Financing Period', 
    // ];

    public function next()
    {
        // $this->validate();
        
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

    public function searchIntroducer()
    {
        if(strlen($this->search_introducer) == 12 ){
            $this->Introducer = Customer::where('icno', $this->search_introducer)->first();
        } else {
            $this->Introducer = new Customer;
        }
    }

    public function searchGuarantor()
    {
        if(strlen($this->search_guarantor) == 12 ){
            $this->Guarantor = Customer::where('icno', $this->search_guarantor)->first();
        } else {
            $this->Guarantor = new Customer;
        }
    }

    public function birthdate()
    {
        $tempIC     = substr($this->Customer->icno, 0, 6); //yymmdd
        $tempyear   = substr($tempIC, 0, 2);             //yy
        $tempmonth  = substr($tempIC, 2, 2);             //mm
        $tempday    = substr($tempIC, 4, 2);             //dd

        if ($tempyear > now())
        {
            $tempyear = '19'.$tempyear;
        } else {
            $tempyear = '20'.$tempyear;
        }
        $this->birthdate  = $tempday.'-'.$tempmonth.'-'.$tempyear;
        return $this->birthdate;
    }

    public function gender()
    {
        $tempGender  = substr($this->Customer->icno, 0, 12);
        $this->Customer->gender_id;
     
        if ($tempGender % 2 == 0) {
            $this->Customer->gender_id == '2';
        } else {
            $this->Customer->gender_id == '1';
        }
        return $this->Customer->gender_id;
    }

    public function mount($product_id)
    {   
        $user = Auth()->user();

        $this->Customer         = Customer::where('icno', $user->icno)->first();
        $this->Customer->birthdate  = $this->birthdate();
        $this->Customer->gender_id   = $this->gender();
        $this->Product          = AccountProduct::where('id',$product_id)->first();
        $this->Account          = AccountMaster::firstOrCreate([
            'cust_id'          => $this->Customer->id,
            'coop_id'          => $user->coop_id,
            'product_id'       => $product_id,
            // 'purchase_price'   => 1,
            'profit_rate'      => $this->Product->profit_rate,
        ]);
        $this->Product          = AccountProduct::find($product_id);
        $this->CustAddress      = $this->Customer->Address()->firstorCreate();
        $this->Family            = CustFamily::firstOrCreate(['cust_id' => $this->Customer->id, 'relationship_id' => 5]);
        $this->FamilyAddress    = $this->Family->Address()->firstorCreate();
        if ($this->Customer->marital_id == 2){
            $married = TRUE;
            if($this->Customer->gender_id == 1 ){
                $family = 2;
            } else {
                $family = 1;
            }
        } else {
            $married = FALSE;
            $family = 5;
        }
        if ($this->Family->family_id != NULL){
            $this->CustFamily = Customer::find($this->Family->family_id);
        } else {
            $this->CustFamily = new Customer;
        }
        $this->Employer         = CustEmployer::firstorCreate(['cust_id' => $this->Customer->id]);
        $this->EmployerAddress  = $this->Employer->Address()->firstorCreate();
        $Introducer              = Introducer::where('coop_id', $user->coop_id)->first();
        if ($Introducer != NULL){
            $this->Introducer    = Customer::find($Introducer->intro_cust_id);
            $this->search_introducer        = $this->Introducer->icno;
        }
        $Guarantor              = Guarantor::where('coop_id', $user->coop_id)->first();
        if ($Guarantor != NULL){
            $this->Guarantor    = Customer::find($Guarantor->guarantor_cust_id);
            $this->search_guarantor       = $this->Guarantor->icno;
        }
        $this->title            = RefCustTitle::all();
        $this->education        = RefEducation::all();
        $this->gender_id        = RefGender::where('id', $this->Customer->gender_id)->get();
        $this->marital          = RefMarital::all();
        $this->race             = RefRace::all();
        $this->state            = RefState::all();
        $this->relationship     = RefRelationship::whereIn('id', [1,2,5,6])->get();
    }

    public function submit()
    {
        $user = Auth()->user();
        // dd($this->Customer->id, $this->Customer->coop_id);
        // dd($this->Customer,$this->CustFamily);
        $this->validate();

        $this->Account->save();
        $this->Customer->save();
        // $this->Customer->birthdate = $this->birthdate;
        if ($this->CustFamily->id != NULL){
            $this->CustFamily->save();
            $this->Family->address()->save($this->FamilyAddress);
        } else {
            $Familymember = Customer::where('icno',$this->CustFamily->icno)->first();
            if ($Familymember != NULL){
                $this->Family->family_id = $Familymember->id;
                $this->Family->save();

                $Familymember->name = $this->CustFamily->name;
                $Familymember->save();

                $this->Family->address()->save($this->FamilyAddress);

            } else {
                $Familymember = Customer::firstOrCreate([
                    'name'            => $this->CustFamily->name,
                    'icno'            => $this->CustFamily->icno,
                    'email'           => $this->CustFamily->email,
                    'mobile_num'      => $this->CustFamily->mobile_num,
                ]);
                $this->Family->family_id = $Familymember->id;
                $this->Family->save();
                $this->Family->address()->save($this->FamilyAddress);
            
            }         
        }
        $this->Employer->save();
        $this->Customer->Address()->save($this->CustAddress);
        $this->Employer->Address()->save($this->EmployerAddress);

        $this->Account->introducers()->firstOrCreate([
            'intro_cust_id' => $this->Introducer->id,
            'coop_id'       => $user->coop_id,
        ]);
        $this->Account->guarantors()->firstOrCreate([
            'guarantor_cust_id' => $this->Guarantor->id,
            'coop_id'       => $user->coop_id,
        ]);

        session()->flash('message', 'Financing application being processed');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');

    }

    public function alertConfirm()
    {
        $this->validate();
        $message  = '<b>Name</b> : '.$this->Customer->name."<br>";
        $message .= '<b>Introducer</b> : '.$this->Introducer->name."<br>";
        $message .= '<b>Guarantor</b> : '.$this->Guarantor->name."<br>";
        $message .= '<b>Product Name</b> : '.$this->Product->name."<br>";
        $message .= '<b>Financing Amount Requested</b> : RM '.$this->Account->purchase_price."<br>";
        $message .= '<b>Financing Term Requested</b> : '.$this->Account->duration." Year<br>";
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'          => 'warning',  
            'title'          => 'Are you sure you want to apply financing for this product?',
            'html'          => $message,
            'note'          => 'Please recheck all your details before click "Submit" button.',
        ]);   
    }

    public function render()
    {
        return view('livewire.page.application.apply-financing.apply-financing')->extends('layouts.head');
    }
}