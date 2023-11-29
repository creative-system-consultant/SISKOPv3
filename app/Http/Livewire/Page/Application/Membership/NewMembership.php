<?php

namespace App\Http\Livewire\Page\Application\Membership;

use App\Models\User;
use App\Models\Address;
use App\Models\ApplyMembership;
use App\Models\Client as Coop;
use App\Models\Customer as FMSCustomer;
use App\Models\SiskopCustomer as Customer;
use App\Models\SiskopEmployer as CustEmployer;
use App\Models\SiskopFamily as CustFamily;
//use App\Models\Membership;
use App\Models\MembershipDocument;
use App\Models\MembershipField;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefState;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;
use Str;

class NewMembership extends Component
{
    use WithFileUploads;

    public User $User;
    //public Membership $Member;
    public ApplyMembership $applymember;
    public Coop $Coop;
    public Customer $Cust;
    public CustFamily $CustFamily;
    public FMSCustomer $CustIntroducer;
    public CustEmployer $Employer;
    public Address $CustAddress;
    public Address $EmployAddress;
    //public Address $FamilyAddress;

    public $Introducer;
    public $field;
    public $document;
    public $title_id;
    public $education_id;
    public $gender_id;
    public $marital_id;
    public $relationship;
    public $race_id;
    public $state_id;
    public $name;
    public $identity_no;
    public $email;
    public $mobile_num;
    public $numpage = 1;
    public $online_file;
    public $online_file2;
    public $online_file3;
    public $online_file4;
    public $search;
    public $mbr_no = [];
    public $birthdate;
    public $activeTab = 0;
    public $tab1 = 1, $tab2 = 0, $tab3 = 0, $tab4 = 0, $tab5 = 0, $tab6 = 0, $tab7 = 0, $tab8 = 0;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rule1 = [
        'Cust.name'                          => 'required',
        'Cust.identity_no'                   => 'required',
        'Cust.phone'                         => 'required',
        'Cust.birthdate'                     => 'required',
        'Cust.race_id'                       => 'required',
        'Cust.gender_id'                     => 'required',
        'Cust.education_id'                  => 'required',
        'Cust.marital_id'                    => 'required',
        'Cust.email'                         => 'required',
        'Cust.title_id'                      => 'required',
    ];

    protected $rule2 = [
        'CustAddress.address1'               => 'required',
        'CustAddress.address2'               => 'required',
        'CustAddress.address3'               => 'nullable',
        'CustAddress.postcode'               => 'required|digits:5',
        'CustAddress.town'                   => 'required',
        'CustAddress.state_id'               => 'required',
        'EmployAddress.address1'             => 'required',
        'EmployAddress.address2'             => 'required',
        'EmployAddress.address3'             => 'nullable',
        'EmployAddress.postcode'             => 'required|digits:5',
        'EmployAddress.town'                 => 'required',
        'EmployAddress.state_id'             => 'required',
    ];

    protected $rule3 = [
        //'FamilyAddress.address1'             => 'required',
        //'FamilyAddress.address2'             => 'required',
        //'FamilyAddress.address3'             => 'nullable',
        //'FamilyAddress.postcode'             => 'required',
        //'FamilyAddress.town'                 => 'required',
        //'FamilyAddress.state_id'             => 'required',
        'CustFamily.name'                    => 'required',
        'CustFamily.identity_no'             => 'required',
        'CustFamily.email'                   => 'nullable',
        'CustFamily.phone_no'                => 'required',
        'CustFamily.relation_id'             => 'required',
    ];

    protected $rule4 = [
        'Employer.name'                      => 'required',
        'Employer.department'                => 'required',
        'Employer.position'                  => 'required',
        'Employer.office_num'                => 'required',
        'Employer.salary'                    => 'required',
        'Employer.worker_num'                => 'required',
    ];

    protected $rule5 = [
        'CustIntroducer.name'                    => 'required',
        'CustIntroducer.icno'                    => 'nullable',
        'CustIntroducer.email'                   => 'nullable',
        'CustIntroducer.mbr_no'                  => 'nullable',
        'search'                             => 'required|numeric|digits:12',
    ];

    protected $rule6 = [
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.share_monthly'          => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
    ];

    protected $rules = [
        'Cust.name'                          => 'required',
        'Cust.identity_no'                   => 'required',
        'Cust.phone'                         => 'required',
        'Cust.birthdate'                     => 'required',
        'Cust.race_id'                       => 'required',
        'Cust.gender_id'                     => 'required',
        'Cust.education_id'                  => 'required',
        'Cust.marital_id'                    => 'required',
        'Cust.email'                         => 'required',
        'Cust.title_id'                      => 'required',
        'CustAddress.address1'               => 'required',
        'CustAddress.address2'               => 'required',
        'CustAddress.address3'               => 'nullable',
        'CustAddress.postcode'               => 'required',
        'CustAddress.town'                   => 'required',
        'CustAddress.state_id'               => 'required',
        'Employer.name'                      => 'required',
        'Employer.department'                => 'required',
        'Employer.position'                  => 'required',
        'Employer.office_num'                => 'required',
        'Employer.salary'                    => 'required',
        'Employer.worker_num'                => 'required',
        'EmployAddress.address1'             => 'required',
        'EmployAddress.address2'             => 'required',
        'EmployAddress.address3'             => 'nullable',
        'EmployAddress.postcode'             => 'required',
        'EmployAddress.town'                 => 'required',
        'EmployAddress.state_id'             => 'required',
        //'FamilyAddress.address1'             => 'required',
        //'FamilyAddress.address2'             => 'required',
        //'FamilyAddress.address3'             => 'nullable',
        //'FamilyAddress.postcode'             => 'required',
        //'FamilyAddress.town'                 => 'required',
        //'FamilyAddress.state_id'             => 'required',
        //'Family.relationship_id'             => 'required',
        'CustFamily.name'                    => 'required',
        'CustFamily.identity_no'             => 'required',
        'CustFamily.email'                   => 'nullable',
        'CustFamily.phone_no'                => 'required',
        'CustFamily.relation_id'             => 'required',
        'CustIntroducer.name'                => 'required',
        'CustIntroducer.icno'                => 'nullable',
        'CustIntroducer.email'               => 'nullable',
        'CustIntroducer.mbr_no'              => 'nullable',
        'search'                             => 'required|numeric|digits:12',
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.share_monthly'          => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
    ];

    // public function updateNumpage($newPage)
    // {
    //     $this->numpage = $newPage;
    // }


    public function previous()
    {
        if ($this->numpage > 1 && $this->numpage <= 8) {
            $this->dispatchBrowserEvent('decrement-tab');
            $this->numpage--;
        }
    }

    public function next($newPage, $tab)
    {

        $this->numpage = $newPage;

        if ($tab != 1) {
            switch ($this->numpage) {
                case 1:
                    $this->validate($this->rule1);
                    $this->birthdate();
                    $this->Cust->save();
                    $this->tab2 = 1;
                    break;
                case 2:
                    $this->validate($this->rule2);
                    $this->CustAddress->save();
                    $this->EmployAddress->save();
                    $this->tab3 = 1;
                    break;
                case 3:
                    $this->validate($this->rule3);
                    $this->CustFamily->name = Str::upper($this->CustFamily->name);
                    $this->CustFamily->save();
                    //$this->Family->save();
                    //$this->FamilyAddress->save();
                    $this->tab4 = 1;
                    break;
                case 4:
                    $this->validate($this->rule4);
                    $this->Employer->save();
                    $this->tab5 = 1;
                    break;
                case 5:
                    $this->validate($this->rule5);
                    $this->Introducer->intro_cust_id = $this->CustIntroducer->id;
                    $this->Introducer->save();
                    $this->tab6 = 1;
                    break;
                case 6:
                    $this->totalfee();
                    $this->validate($this->rule6);
                    $this->applymember->save();
                    $this->tab7 = 1;
                    break;
                case 7:
                    $this->fileupload();
                    $this->tab8 = 1;
                    break;
            }
            $this->dispatchBrowserEvent('increment-tab');
            $this->numpage++;
        }



        $this->render();
    }

    public function nextTab($curPage, $newPage, $tab)
    {
        $this->activeTab = $newPage - 1;

        $this->numpage = $newPage;
        if ($tab == 1) {
            switch ($curPage) {
                case 1:
                    $this->validate($this->rule1);
                    $this->birthdate();
                    $this->Cust->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 2:
                    $this->validate($this->rule2);
                    $this->CustAddress->save();
                    $this->EmployAddress->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 3:
                    $this->validate($this->rule3);
                    //$this->CustFamily->save();
                    //$this->Family->save();
                    //$this->FamilyAddress->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);
                    break;
                case 4:
                    $this->validate($this->rule4);
                    $this->Employer->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 5:
                    $this->validate($this->rule5);
                    $this->Introducer->intro_cust_id = $this->CustIntroducer->id;
                    $this->Introducer->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 6:
                    $this->totalfee();
                    $this->validate($this->rule6);
                    $this->applymember->save();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
                case 7:
                    $this->fileupload();
                    $this->dispatchBrowserEvent('tab-changed', ['newActiveTab' => $this->activeTab]);

                    break;
            }
        }


        $this->render();
    }



    public function searchUser()
    {
        if (strlen($this->search) == 12) {
            $result = FMSCustomer::where('identity_no', $this->search)->first();
            if ($result == NULL) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'warning!',
                    'text'  => 'No User with this IC',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 10000,
                ]);
            } else {
                $this->CustIntroducer = $result;
            }
        }
    }

    public function updatedCustIcno()
    {
        $this->Cust->birthdate = $this->birthdate();
    }

    public function birthdate()
    {
        $tempIC     = substr($this->Cust->identity_no, 0, 6);   //yymmdd
        $tempyear   = substr($tempIC, 0, 2);             //yy
        $tempmonth  = substr($tempIC, 2, 2);             //mm
        $tempday    = substr($tempIC, 4, 2);             //dd

        if ($tempyear > now()) {
            $tempyear = '19' . $tempyear;
        } else {
            $tempyear = '20' . $tempyear;
        }
        //$this->birthdate  = $tempday.'-'.$tempmonth.'-'.$tempyear;
        $this->birthdate  = $tempyear . '-' . $tempmonth . '-' . $tempday;
        return $this->birthdate;
    }

    public function gender()
    {
        $tempGender  = substr($this->Cust->identity_no, 0, 12);
        $this->Cust->gender_id;

        if ($tempGender % 2 == 0) {
            $this->Cust->gender_id == '2';
        } else {
            $this->Cust->gender_id == '1';
        }
        return $this->Cust->gender_id;
    }

    /*
    public function load_family()
    {
        //$this->CustFamily = new Customer;
        $ic = $this->CustFamily->icno;
        if ($this->Family->relationship_id != NULL) {
            $this->Family            = CustFamily::firstOrCreate([
                'cust_id'         => $this->Cust->id,
                'relationship_id' => $this->Family->relationship_id
            ], ['created_by' => $this->User->name]);
            if ($ic != NULL && strlen($ic) == 12) {
                $this->CustFamily    = Customer::where([
                    ['icno', $ic],
                    ['client_id', $this->User->client_id]
                ])
                    ->firstOrCreate([
                        'icno'    => $ic,
                        'client_id' => $this->User->client_id
                    ], [
                        'name'       => $this->CustFamily->name ?? '',
                        'created_by' => $this->User->name,
                    ]);
                $this->Family->family_id = $this->CustFamily->id;
                $this->Family->save();
                $this->FamilyAddress = $this->CustFamily->Address()->firstOrCreate();
                $this->FamilyAddress->save();
            }
        }
    }*/

    public function mount()
    {
        $this->User = auth()->user();
        $this->Coop = Coop::find($this->User->client_id);
        $this->Cust = Customer::firstOrCreate([
            'identity_no' => $this->User->icno,
            'client_id' => $this->Coop->id
        ], [
            'name'      => $this->User->name,
            'phone'     => $this->User->phone_no,
        ]);

        $this->Cust->email = $this->Cust->email ?? $this->User->email;
        if ($this->Cust->ref_no != NULL) {
            session()->flash('message', 'You are already a member of ' . $this->Coop->name);
            session()->flash('time', 10000);
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('home');
        }

        $this->Cust->birthdate   = $this->birthdate();
        $this->Cust->gender_id   = $this->gender();
        $this->CustAddress       = $this->Cust->Address()->firstOrCreate();

        $this->CustFamily  = CustFamily::firstOrCreate([
            'cif_id'        => $this->Cust->id,
            'client_id'     => $this->User->client_id,
        ], []);

        //where(, )->
        /*
        $this->FamilyAddress     = new Address;

        $family = 
        if ($family != NULL) {
            $this->Family = $family;
            $this->CustFamily = Customer::find($family->family_id);
            $this->FamilyAddress = $this->CustFamily->Address()->firstOrCreate();
        }
        */

        /*
        $this->Member            = Membership::firstOrCreate(
                                    [
                                        'cust_id'   => $this->User->id,
                                        'client_id' => $this->User->client_id,
                                    ],[
                                        'created_by' => $this->User->name,
                                    ]);
        $this->field             = MembershipField::where('membership_id', $this->Member->id)->get();
        $this->document          = MembershipDocument::where('membership_id', $this->Member->id)->get();
        */
        $this->CustIntroducer    = new FMSCustomer;
        $this->Introducer        = $this->Cust->introducer()->firstOrCreate([], [
            'client_id' => $this->User->client_id,
        ]);
        if ($this->Introducer != NULL) {
            $this->CustIntroducer = FMSCustomer::where('id', $this->Introducer->intro_cust_id)->firstOrNew();
            $this->search        = $this->CustIntroducer->identity_no;
        }
        $this->applymember       = ApplyMembership::firstOrCreate(['cust_id' => $this->Cust->id, 'client_id' => $this->User->client_id], ['user_id' => $this->User->id]);
        $this->applymember->register_fee = 50;
        $this->applymember->share_fee = 50;
        $this->applymember->contribution_fee = 50;
        $this->applymember->save();

        $this->Employer          = CustEmployer::firstOrCreate(['cust_id' => $this->Cust->id],);
        $this->EmployAddress     = $this->Employer->Address()->firstOrCreate();

        $this->title_id          = RefCustTitle::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->education_id      = RefEducation::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->gender_id         = RefGender::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->marital_id        = RefMarital::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->relationship      = RefRelationship::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->race_id           = RefRace::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->state_id          = RefState::where([['client_id', $this->User->client_id], ['status', '1']])->get();
    }

    public function fileupload()
    {
        $customers = Customer::where('identity_no', $this->User->identity_no)->first();

        if ($this->online_file) {
            $filepath = 'Files/' . $customers->id . '/membership/IC_Photo' . '.' . $this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file, 'IC_Photo' . '.' . $this->online_file->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'IC_Photo',
            ], [
                'filedesc' => 'IC Photo (Front & Back)',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);
        };

        if ($this->online_file2) {
            $filepath = 'Files/' . $customers->id . '/membership/WorkerCard' . '.' . $this->online_file2->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file2, 'WorkerCard' . '.' . $this->online_file2->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'WorkerCard',
            ], [
                'filedesc' => 'Worker Card',
                'filetype' => $this->online_file2->extension(),
                'filepath' => $filepath,
            ]);
        };

        if ($this->online_file3) {
            $filepath = 'Files/' . $customers->id . '/membership/Paycheck' . '.' . $this->online_file3->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file3, 'Paycheck' . '.' . $this->online_file3->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'Paycheck',
            ], [
                'filedesc' => 'Paycheck',
                'filetype' => $this->online_file3->extension(),
                'filepath' => $filepath,
            ]);
        };

        if ($this->online_file4) {
            $filepath = 'Files/' . $customers->id . '/membership/LastMonthPaycheck' . '.' . $this->online_file4->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id . '/membership//', $this->online_file4, 'LastMonthPaycheck' . '.' . $this->online_file4->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'LastMonthPaycheck',
            ], [
                'filedesc' => 'Last Month Paycheck',
                'filetype' => $this->online_file4->extension(),
                'filepath' => $filepath,
            ]);
        };

        $this->render();
    }

    public function totalfee()
    {
        $this->applymember->update([
            'total_fee' => $this->applymember->register_fee + $this->applymember->share_fee + $this->applymember->contribution_fee,
        ]);
    }

    public function submit()
    {
        $this->applymember->make_approvals();
        $this->applymember->update([
            'flag' => 1,
            'step' => 1,
        ]);

        session()->flash('message', 'Membership Application Registered');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function submitto()
    {
        $customers = Customer::where('identity_no', $this->User->identity_no)->first();

        $this->validate();
        $this->fileupload();

        $this->Cust->save();
        $this->Employer->save();
        /*
        if ($this->CustFamily->id != NULL) {
            $this->CustFamily->save();
            $this->Family->address()->save($this->FamilyAddress);
        } else {
            $Familymember = Customer::where('icno', $this->CustFamily->icno)->first();
            if ($Familymember != NULL) {
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
        }*/

        $this->Cust->address()->save($this->CustAddress);
        //$this->Employer->address()->save($this->EmployAddress);
        $this->applymember->introducers()->firstOrCreate([
            'intro_cust_id' => $this->introducer->id,
            'client_id'       => $this->User->client_id,
        ]);
        // $this->Family->address()->save($this->FamilyAddress);

        //cara 1
        // $this->applymember->flag  = 1;
        // $this->applymember->step  = 1;
        // $this->applymember->save();
        //cara 2
        $this->applymember->update([
            'flag' => 1,
            'step' => 1,
        ]);

        // $this->CustFamily->update([
        //     'name'          => $this->CustFamily['name'],
        //     'icno'          => $this->CustFamily['icno'],
        //     'email'         => $this->CustFamily['email'],
        //     'mobile_num'    => $this->CustFamily['mobile_num'],
        //     'birthdate'     => $this->CustFamily['birthdate'],
        // ]);

        session()->flash('message', 'Membership Application Registered');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function alertConfirm()
    {
        $message  = '<b>Name</b> : ' . $this->Cust->name . "<br>";
        $message .= '<b>Introducer</b> : ' . $this->CustIntroducer->name . "<br>";
        $message .= '<b>Register Fee</b> : RM' . $this->applymember->register_fee . "<br>";
        $message .= '<b>Share Fee</b> : RM' . $this->applymember->share_fee . "<br>";
        $message .= '<b>Contribution Fee</b> : RM' . $this->applymember->contribution_fee . "<br>";
        $message .= '<b>Total Fee</b> : RM' . $this->applymember->total_fee . "<br>";

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'          => 'warning',
            'title'         => 'Are you sure you want to apply for membership?',
            'html'          => $message,
            'note'          => 'Please recheck all your details before click "Submit" button.',
        ]);
    }

    public function deb()
    {
        dd([
            'User'        => $this->User,
            'member'      => $this->Member,
            'applymember' => $this->applymember,
            'customer'    => $this->Cust,
            'custfamily'  => $this->CustFamily,
            //'family'      => $this->Family,
            'employer'    => $this->Employer,
            'address'     => $this->CustAddress,
            //'emp address' => $this->EmployAddress,
            'fam address' => $this->FamilyAddress,
            //'address fams' => $this->CustFamily->address()->firstOrCreate(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.application.membership.new-membership')->extends('layouts.head');
    }
}
