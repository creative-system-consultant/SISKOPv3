<?php

namespace App\Http\Livewire\Page\Application\ApplyFinancing;

use Livewire\Component;

use App\Models\AccountApplication;
use App\Models\AccountProduct;
use App\Models\Address;
use App\Models\CoopRules;
use App\Models\Customer;
use App\Models\CustFamily;
use App\Models\CustEmployer;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefState;
use App\Models\Ref\RefRelationship;
use App\Models\User;
use Livewire\WithFileUploads;
use Storage;

class ApplyFinancing extends Component
{
    use WithFileUploads;

    public AccountApplication $Account;
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
    public User $User;
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
    public $max_active;
    public $online_file;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rule1 = [
        'Product.name'                     => 'required',
        'Product.profit_rate'              => 'required',
        'Account.purchase_price'           => 'required|numeric|gte:Product.amt_min|lte:Product.amt_max',
        'Account.duration'                 => 'required|gte:Product.term_min|lte:Product.term_max',
        'Customer.name'                    => 'required|string',
        'Customer.identity_no'             => 'required',
        'Customer.birthdate'               => 'required',
        'Customer.mobile_num'              => 'nullable',
        'CustAddress.address1'             => 'required',
        'CustAddress.address2'             => 'required',
        'CustAddress.address3'             => 'nullable',
        'CustAddress.town'                 => 'required',
        'CustAddress.postcode'             => 'required',
        'CustAddress.state_id'             => 'required',
        'Customer.email'                   => 'required|email',
        'Customer.title_id'                => 'required',
        'Customer.education_id'            => 'required|numeric',
        'Customer.gender_id'               => 'required',
        'Customer.marital_id'              => 'required',
        'Customer.race_id'                 => 'required',
        'Customer.ref_no'                  => 'nullable',
        'Family.relationship_id'           => 'required',
        'CustFamily.name'                  => 'required|string',
        'CustFamily.icno'                  => 'required|numeric|digits:12',
        'CustFamily.mobile_num'            => 'required|numeric',
        'FamilyAddress.address1'           => 'nullable',
        'FamilyAddress.address2'           => 'nullable',
        'FamilyAddress.address3'           => 'nullable',
        'FamilyAddress.town'               => 'nullable',
        'FamilyAddress.postcode'           => 'nullable',
        'FamilyAddress.state_id'           => 'nullable',
        'Employer.name'                    => 'required|string',
        'Employer.department'              => 'nullable|string',
        'Employer.position'                => 'required|string',
        'Employer.office_num'              => 'required|numeric',
        'Employer.salary'                  => 'required|numeric',
        'Employer.worker_num'              => 'required|string',
        'EmployerAddress.address1'         => 'required',
        'EmployerAddress.address2'         => 'required',
        'EmployerAddress.address3'         => 'nullable',
        'EmployerAddress.town'             => 'required',
        'EmployerAddress.postcode'         => 'required',
        'EmployerAddress.state_id'         => 'required',
    ];

    protected $rule2 = [
        'search_introducer'                => 'required|numeric|digits:12',
        'Introducer.name'                  => 'required',
        'Introducer.icno'                  => 'nullable',
        'Introducer.email'                 => 'nullable',
        'Introducer.mbr_no'                => 'nullable',
        'Guarantor.name'                   => 'required',
        'Guarantor.icno'                   => 'nullable',
        'Guarantor.email'                  => 'nullable',
        'Guarantor.mbr_no'                 => 'nullable',
        'search_guarantor'                 => 'required|numeric|digits:12',
    ];

    protected $rule3 = [];
    protected $rule4 = [];
    protected $rule5 = [];

    protected $rules = [
        'Product.name'                     => 'required',
        'Product.profit_rate'              => 'required',
        'Account.purchase_price'           => 'required|numeric|gte:Product.amt_min|lte:Product.amt_max',
        'Account.duration'                 => 'required|gte:Product.term_min|lte:Product.term_max',
        'Customer.name'                    => 'required|string',
        'Customer.identity_no'             => 'required',
        'Customer.birthdate'               => 'required',
        'Customer.mobile_num'              => 'required|numeric',
        'Customer.ref_no'                  => 'nullable',
        'CustAddress.address1'             => 'required',
        'CustAddress.address2'             => 'required',
        'CustAddress.address3'             => 'nullable',
        'CustAddress.town'                 => 'required',
        'CustAddress.postcode'             => 'required',
        'CustAddress.state_id'             => 'required',
        'Customer.email'                   => 'required|email',
        'Customer.title_id'                => 'nullable',
        'Customer.education_id'            => 'required',
        'Customer.gender_id'               => 'required',
        'Customer.marital_id'              => 'required',
        'Customer.race_id'                 => 'required',
        'Family.relationship_id'           => 'required',
        'CustFamily.name'                  => 'required|string',
        'CustFamily.icno'                  => 'required|numeric|digits:12',
        'CustFamily.mobile_num'            => 'required|numeric',
        'FamilyAddress.address1'           => 'nullable',
        'FamilyAddress.address2'           => 'nullable',
        'FamilyAddress.address3'           => 'nullable',
        'FamilyAddress.town'               => 'nullable',
        'FamilyAddress.postcode'           => 'nullable',
        'FamilyAddress.state_id'           => 'nullable',
        'Employer.name'                    => 'required|string',
        'Employer.department'              => 'nullable|string',
        'Employer.position'                => 'required|string',
        'Employer.office_num'              => 'required|numeric',
        'Employer.salary'                  => 'required|numeric',
        'Employer.worker_num'              => 'required|string',
        'EmployerAddress.address1'         => 'required',
        'EmployerAddress.address2'         => 'required',
        'EmployerAddress.address3'         => 'nullable',
        'EmployerAddress.town'             => 'required',
        'EmployerAddress.postcode'         => 'required',
        'EmployerAddress.state_id'         => 'required',
        'search_introducer'                => 'required|numeric|digits:12',
        'Introducer.name'                  => 'required',
        'Introducer.icno'                  => 'nullable',
        'Introducer.email'                 => 'nullable',
        'Introducer.mbr_no'                => 'nullable',
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

    protected $validationAttributes = [
        'Introducer.name'    => 'Introducer Name',
        'Guarantor.name'     => 'Guarantor Name',
    ];

    public function next()
    {
        if ($this->numpage == 1) {
            $this->validate($this->rule1);

            $this->Account->save();
            $this->Customer->save();
            $this->CustAddress->save();
            $this->CustFamily->client_id = $this->User->client_id;
            $this->CustFamily->save();
            $this->Family->family_id = $this->CustFamily->id;
            $this->Family->save();
            $this->Employer->save();
            $this->EmployerAddress->save();
        }

        if ($this->numpage == 2) {
            $this->validate($this->rule2);
            $this->Account->introducers()->firstOrCreate([
                'intro_cust_id' => $this->Introducer->id,
                'client_id'     => $this->User->client_id,
            ]);
            $this->Account->guarantors()->firstOrCreate([
                'guarantor_cust_id' => $this->Guarantor->id,
                'client_id'         => $this->User->client_id,
            ]);
        }

        if ($this->numpage == 3) {
            if ($this->online_file) {
                $filepath = 'Files/' . $this->Customer->id . '/Financing//' . $this->Account->id . '/IC_Photo' . '.' . $this->online_file->extension();

                Storage::disk('local')->putFileAs('public/Files/' . $this->Customer->id . '/Financing//' . $this->Account->id . '//', $this->online_file, 'IC_Photo' . '.' . $this->online_file->extension());

                $this->Account->files()->updateOrCreate([
                    'filename' => 'IC_Photo',
                ], [
                    'filedesc' => 'IC Photo (Front & Back)',
                    'filetype' => $this->online_file->extension(),
                    'filepath' => $filepath,
                ]);
            };
        }
        //if ($this->numpage == 3){ $this->validate($this->rule3); }
        //if ($this->numpage == 4){ $this->validate($this->rule4); }
        //if ($this->numpage == 5){ $this->validate($this->rule5); }

        if ($this->numpage < 5) {
            $this->numpage++;
        }
    }

    public function back()
    {
        if ($this->numpage > 0) {
            $this->numpage--;
        }
    }

    public function searchIntroducer()
    {
        if (strlen($this->search_introducer) == 12) {
            $Introducer = Customer::where('icno', $this->search_introducer)->first();
            if ($Introducer == NULL) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'NO MEMBER',
                    'text'  => 'There are no member with that IC Number, please use another IC Number',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 1500,
                ]);
            } else {
                $this->Introducer = $Introducer;
            }
        }
    }

    public function searchGuarantor()
    {
        if (strlen($this->search_guarantor) == 12) {
            $Guarantor = Customer::where('icno', $this->search_guarantor)->first();
            if ($Guarantor == NULL) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'NO MEMBER',
                    'text'  => 'There are no member with that IC Number, please use another IC Number',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 1500,
                ]);
            } else {
                $this->Guarantor = $Guarantor;
            }
        }
    }

    public function birthdate()
    {
        $tempIC     = substr($this->Customer->icno, 0, 6); //yymmdd
        $tempyear   = substr($tempIC, 0, 2);             //yy
        $tempmonth  = substr($tempIC, 2, 2);             //mm
        $tempday    = substr($tempIC, 4, 2);             //dd

        if ($tempyear > now()) {
            $tempyear = '19' . $tempyear;
        } else {
            $tempyear = '20' . $tempyear;
        }
        $this->birthdate  = $tempday . '-' . $tempmonth . '-' . $tempyear;
        return $this->birthdate;
    }

    public function gender()
    {
        $tempGender  = substr($this->Customer->icno, 11, 12);
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
        $this->User = User::find(Auth()->user()->id);
        $client_id = $this->User->client_id;

        $this->Customer             = Customer::where([['client_id', $this->User->client_id], ['identity_no', $this->User->icno]])->firstOrFail();
        $this->Customer->birthdate  = $this->birthdate();
        $this->Customer->gender_id  = $this->gender();
        $this->Customer->email      = $this->Customer->email ?? $this->User->email;

        $this->Product    = AccountProduct::where('uuid', $product_id)->first();
        $max_active = CoopRules::where([['ruleable_id', $client_id], ['name', 'max_active']])->first();
        $this->max_active = $max_active ? $max_active->value : '0';

        $Account          = AccountApplication::where([
            ['cust_id', $this->Customer->id],
            ['client_id', $this->User->client_id],
            ['product_id', $this->Product->id],
            ['account_status', 0]
        ])->get();

        $AllAccount          = AccountApplication::where([
            ['cust_id', $this->Customer->id],
            ['client_id', $this->User->client_id]
        ])->whereNotIn('account_status', [3, 4, 23, 24, 25])->get();

        if ($Account->count() >= $this->Product->apply_limit) {
            session()->flash('message', 'There can be only ' . $this->Product->apply_limit . ' Pending Application of product ' . $this->Product->name . ' exists');
            session()->flash('warning');
            session()->flash('time', 10000);
            session()->flash('title', 'Warning');

            return redirect()->route('financing.list');
        }
        if ($AllAccount->count() >= $this->max_active && $this->max_active != 0) {
            session()->flash('message', 'There can be only ' . $this->max_active . ' Pending Application for all product');
            session()->flash('warning');
            session()->flash('time', 10000);
            session()->flash('title', 'Warning');

            return redirect()->route('financing.list');
        }

        $this->Account       = AccountApplication::firstOrCreate([
            'cust_id'        => $this->Customer->id,
            'client_id'      => $this->User->client_id,
            'product_id'     => $this->Product->id,
            'profit_rate'    => $this->Product->profit_rate,
            'account_status' => 0
        ]);

        $this->CustAddress   = $this->Customer->Address()->firstorCreate();

        if ($this->Customer->marital_id == 2) {
            $married = TRUE;
            if ($this->Customer->gender_id == 1) {
                $family = 2;
            } else {
                $family = 1;
            }
        } else {
            $married = FALSE;
            $family = 5;
        }

        $this->Family           = CustFamily::firstOrCreate(['cust_id' => $this->Customer->id, 'relationship_id' => $family]);
        $this->FamilyAddress    = $this->Family->Address()->firstorCreate();

        if ($this->Family->family_id != NULL) {
            $this->CustFamily = Customer::find($this->Family->family_id);
        } else {
            $this->CustFamily = new Customer;
        }

        $this->Family->family_id = $this->CustFamily->id;
        $this->CustFamily->client_id = $this->User->client_id;

        $this->Employer         = CustEmployer::firstorCreate(['cust_id' => $this->Customer->id]);
        $this->EmployerAddress  = $this->Employer->Address()->firstorCreate();

        $intro = $this->Account->introducers()->first();
        $guaran = $this->Account->guarantors()->first();

        if ($intro != NULL) {
            $this->Introducer = Customer::where([['icno', $intro->data->icno], ['client_id', $this->User->client_id]])->first();
            $this->search_introducer = $this->Introducer->icno;
        }
        if ($guaran != NULL) {
            $this->Guarantor = Customer::where([['icno', $guaran->data->icno], ['client_id', $this->User->client_id]])->first();
            $this->search_guarantor  = $this->Guarantor->icno;
        }

        $this->title            = RefCustTitle::all();
        $this->education        = RefEducation::all();
        $this->gender           = RefGender::where('client_id', $this->User->client_id)->get();
        $this->marital          = RefMarital::all();
        $this->race             = RefRace::all();
        $this->state            = RefState::all();
        $this->relationship     = RefRelationship::all();
        //dd($this->Customer);
    }

    public function submit()
    {
        $this->validate();
        $this->Account->apply_step        = 1;
        $this->Account->account_status    = 1;
        $this->Account->approved_limit    = $this->Account->purchase_price;
        $this->Account->duration          = $this->Account->duration * 12;
        $this->Account->approved_duration = $this->Account->duration;
        $this->Account->save();
        $this->Account->make_approvals();

        /*
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
        $this->Employer->Address()->save($this->EmployerAddress); */

        $this->Account->introducers()->firstOrCreate([
            'intro_cust_id' => $this->Introducer->id,
            'client_id'     => $this->User->client_id,
        ]);
        $this->Account->guarantors()->firstOrCreate([
            'guarantor_cust_id' => $this->Guarantor->id,
            'client_id'         => $this->User->client_id,
        ]);

        //$this->Account->sendWS('Application '.$this->Account->product->name.' have been submitted and will be reviewed');

        session()->flash('message', 'Financing application being processed');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function alertConfirm()
    {
        $this->validate();
        $message  = '<b>Name</b> : ' . $this->Customer->name . "<br>";
        $message .= '<b>Introducer</b> : ' . $this->Introducer->name . "<br>";
        $message .= '<b>Guarantor</b> : ' . $this->Guarantor->name . "<br>";
        $message .= '<b>Product Name</b> : ' . $this->Product->name . "<br>";
        $message .= '<b>Financing Amount Requested</b> : RM ' . $this->Account->purchase_price . "<br>";
        $message .= '<b>Financing Term Requested</b> : ' . $this->Account->duration . " Year<br>";
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'          => 'warning',
            'title'         => 'Are you sure you want to apply financing for this product?',
            'html'          => $message,
            'note'          => 'Please recheck all your details before click "Submit" button.',
        ]);
    }

    public function deb()
    {
        dd([
            'Account'   => $this->Account,
            'Account Files'   => $this->Account->files,
            'Customer'  => $this->Customer,
            'File 1'    => $this->online_file,
        ]);
    }

    public function render()
    {
        return view('livewire.page.application.apply-financing.apply-financing')->extends('layouts.head');
    }
}
