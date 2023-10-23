<?php

namespace App\Http\Livewire\Page\Application\Membership;

use App\Models\User;
use App\Models\Address;
use App\Models\ApplyMembership;
use App\Models\Coop;
use App\Models\Customer;
use App\Models\CustEmployer;
use App\Models\CustFamily;
use App\Models\Membership;
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

class NewMembership extends Component
{
    use WithFileUploads;

    public User $User;
    public Membership $Member;
    public ApplyMembership $applymember;
    public Coop $Coop;
    public Customer $Cust;
    public Customer $CustFamily;
    public Customer $CustIntroducer;
    public CustEmployer $Employer;
    public CustFamily $Family;
    public Address $CustAddress;
    public Address $EmployAddress;
    public Address $FamilyAddress;

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
    public $icno;
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

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rule1 = [
        'Cust.name'                          => 'required',
        'Cust.icno'                          => 'required',
        'Cust.mobile_num'                    => 'required',
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
        'CustAddress.def_state_id'           => 'required',
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
        'EmployAddress.def_state_id'         => 'required',
        'FamilyAddress.address1'             => 'required',
        'FamilyAddress.address2'             => 'required',
        'FamilyAddress.address3'             => 'nullable',
        'FamilyAddress.postcode'             => 'required',
        'FamilyAddress.town'                 => 'required',
        'FamilyAddress.def_state_id'         => 'required',
        'Family.relationship_id'             => 'required',
        'CustFamily.name'                    => 'required',
        'CustFamily.icno'                    => 'required',
        //'CustFamily.email'                   => 'required',
        'CustFamily.mobile_num'              => 'required',
    ];

    protected $rule2 = [
        'CustIntroducer.name'                    => 'required',
        'CustIntroducer.icno'                    => 'nullable',
        'CustIntroducer.email'                   => 'nullable',
        'CustIntroducer.mbr_no'                  => 'nullable',
        'search'                             => 'required|numeric|digits:12',
    ];

    protected $rule3 = [
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
    ];

    protected $rules = [
        'Cust.name'                          => 'required',
        'Cust.icno'                          => 'required',
        'Cust.mobile_num'                    => 'required',
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
        'CustAddress.def_state_id'           => 'required',
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
        'EmployAddress.def_state_id'         => 'required',
        'FamilyAddress.address1'             => 'required',
        'FamilyAddress.address2'             => 'required',
        'FamilyAddress.address3'             => 'nullable',
        'FamilyAddress.postcode'             => 'required',
        'FamilyAddress.town'                 => 'required',
        'FamilyAddress.def_state_id'         => 'required',
        'Family.relationship_id'             => 'required',
        'CustFamily.name'                    => 'required',
        'CustFamily.icno'                    => 'required',
        //'CustFamily.email'                   => 'required',
        'CustFamily.mobile_num'              => 'required',
        'CustIntroducer.name'                => 'required',
        'CustIntroducer.icno'                => 'nullable',
        'CustIntroducer.email'               => 'nullable',
        'CustIntroducer.mbr_no'              => 'nullable',
        'search'                             => 'required|numeric|digits:12',
        'applymember.register_fee'           => 'required|gte:50|numeric',
        'applymember.share_fee'              => 'required|gte:50|numeric',
        'applymember.contribution_fee'       => 'required|gte:50|numeric',
        'applymember.total_fee'              => 'required|numeric',
    ];

    public function next()
    {
        if ($this->numpage == 1){
            $this->validate($this->rule1);
            $this->birthdate();

            $this->Cust->save();
            $this->CustAddress->save();
            $this->CustFamily->save();
            $this->Family->save();
            $this->FamilyAddress->save();
            $this->Employer->save();
            $this->EmployAddress->save();
        }
        if ($this->numpage == 2){
            $this->validate($this->rule2);
            $this->Introducer->intro_cust_id = $this->CustIntroducer->id;
            $this->Introducer->save();
        }

        if ($this->numpage == 3){
            $this->totalfee();
            $this->validate($this->rule3);
            $this->applymember->save();
        }

        if ($this->numpage == 4){
            $this->fileupload();
        }

        if ($this->numpage < 5){
            $this->numpage++;
        }

        $this->render();

    }

    public function back()
    {
        if ($this->numpage > 0){
            $this->numpage--;
        }
    }

    public function searchUser()
    {
        if(strlen($this->search) == 12 ){
            $this->CustIntroducer = Customer::where('icno', $this->search)->first();
        }
    }

    public function updatedCustIcno()
    {
        $this->Cust->birthdate = $this->birthdate();
    }

    public function birthdate()
    {
        $tempIC     = substr($this->Cust->icno, 0, 6);   //yymmdd
        $tempyear   = substr($tempIC, 0, 2);             //yy
        $tempmonth  = substr($tempIC, 2, 2);             //mm
        $tempday    = substr($tempIC, 4, 2);             //dd

        if ($tempyear > now())
        {
            $tempyear = '19'.$tempyear;
        } else {
            $tempyear = '20'.$tempyear;
        }
        //$this->birthdate  = $tempday.'-'.$tempmonth.'-'.$tempyear;
        $this->birthdate  = $tempyear.'-'.$tempmonth.'-'.$tempday;
        return $this->birthdate;

    }

    public function gender()
    {
        $tempGender  = substr($this->Cust->icno, 0, 12);
        $this->Cust->gender_id;

        if ($tempGender % 2 == 0) {
            $this->Cust->gender_id == '2';
        } else {
            $this->Cust->gender_id == '1';
        }
        return $this->Cust->gender_id;
    }

    public function load_family()
    {
        //$this->CustFamily = new Customer;
        $ic = $this->CustFamily->icno;
        if ($this->Family->relationship_id != NULL){
            $this->Family            = CustFamily::firstOrCreate([
                    'cust_id'         => $this->Cust->id, 
                    'relationship_id' => $this->Family->relationship_id
                ],[ 'created_by' => $this->User->name]);
            if ($ic != NULL && strlen($ic) == 12){
                $this->CustFamily    = Customer::where([
                                            ['icno', $ic],
                                            ['client_id', $this->User->client_id]
                                    ])
                                    ->firstOrCreate([
                                        'icno'    => $ic,
                                        'client_id' => $this->User->client_id
                                    ],[
                                        'name'       => $this->CustFamily->name ?? '',
                                        'created_by' => $this->User->name,
                                    ]);
                $this->Family->family_id = $this->CustFamily->id;
                $this->Family->save();
                $this->FamilyAddress = $this->CustFamily->Address()->firstOrCreate();
                $this->FamilyAddress->save();
            }
        }
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->Coop = Coop::find($this->User->client_id);
        $this->Cust = Customer::firstOrCreate([
            'icno'      => $this->User->icno,
            'client_id' => $this->Coop->id
        ],[
            'name'      => $this->User->name,
        ]);
        $this->Cust->email = $this->Cust->email ?? $this->User->email;
        if ($this->Cust->ref_no != NULL){
            session()->flash('message', 'You are already a member of '.$this->Coop->name);
            session()->flash('warning');
            session()->flash('title');

            return redirect()->route('home');
        }
        $this->Cust->birthdate   = $this->birthdate();
        $this->Cust->gender_id   = $this->gender();
        $this->CustAddress       = $this->Cust->Address()->firstOrCreate();

        $this->Family            = new CustFamily;
        $this->CustFamily        = new Customer;
        $this->FamilyAddress     = new Address;

        $family = CustFamily::where('cust_id', $this->Cust->id)->first();
        if ($family != NULL){
            $this->Family = $family;
            $this->CustFamily = Customer::find($family->family_id);
            $this->FamilyAddress = $this->CustFamily->Address()->firstOrCreate();
        }

        $this->Member            = Membership::where('client_id', $this->User->client_id)->first();
        $this->field             = MembershipField::where('membership_id', $this->Member->id)->get();
        $this->document          = MembershipDocument::where('membership_id', $this->Member->id)->get();
        $this->CustIntroducer    = new Customer;
        $this->Introducer        = $this->Cust->introducer()->firstOrCreate([
                                    ],[
                                        'client_id' => $this->User->client_id,
                                    ]);
        if ($this->Introducer != NULL){
            $this->CustIntroducer= Customer::where('id', $this->Introducer->intro_cust_id)->firstOrNew();
            $this->search        = $this->CustIntroducer->icno;
        }
        $this->applymember       = ApplyMembership::firstOrCreate(['cust_id' => $this->Cust->id, 'client_id' => $this->User->client_id],[]);
        $this->applymember->register_fee = 50;
        $this->applymember->share_fee = 50;
        $this->applymember->contribution_fee = 50;
        $this->applymember->save();

        $this->Employer          = CustEmployer::firstOrCreate(['cust_id' => $this->Cust->id],);
        $this->EmployAddress     = $this->Employer->Address()->firstOrCreate();

        $this->title_id          = RefCustTitle::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->education_id      = RefEducation::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->gender_id         = RefGender::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->marital_id        = RefMarital::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->relationship      = RefRelationship::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->race_id           = RefRace::where([['client_id', $this->User->client_id],['status','1']])->get();
        $this->state_id          = RefState::where([['client_id', $this->User->client_id],['status','1']])->get();

    }

    public function fileupload()
    {
        $customers = Customer::where('icno', $this->User->icno)->first();

        if($this->online_file){
            $filepath = 'Files/'.$customers->id.'/membership/IC_Photo'.'.'.$this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership//',$this->online_file, 'IC_Photo'.'.'.$this->online_file->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'IC_Photo',
            ],[
                'filedesc' => 'IC Photo (Front & Back)',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file2){
            $filepath = 'Files/'.$customers->id.'/membership/WorkerCard'.'.'.$this->online_file2->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership//',$this->online_file2, 'WorkerCard'.'.'.$this->online_file2->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'WorkerCard',
            ],[
                'filedesc' => 'Worker Card',
                'filetype' => $this->online_file2->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file3){
            $filepath = 'Files/'.$customers->id.'/membership/Paycheck'.'.'.$this->online_file3->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership//',$this->online_file3, 'Paycheck'.'.'.$this->online_file3->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'Paycheck',
            ],[
                'filedesc' => 'Paycheck',
                'filetype' => $this->online_file3->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file4){
            $filepath = 'Files/'.$customers->id.'/membership/LastMonthPaycheck'.'.'.$this->online_file4->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership//',$this->online_file4, 'LastMonthPaycheck'.'.'.$this->online_file4->extension());

            $this->applymember->files()->updateOrCreate([
                'filename' => 'LastMonthPaycheck',
            ],[
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
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function submitto()
    {
        $customers = Customer::where('icno', $this->User->icno)->first();

        $this->validate();
        $this->fileupload();

        $this->Cust->save();
        $this->Employer->save();
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

        $this->Cust->address()->save($this->CustAddress);
        $this->Employer->address()->save($this->EmployAddress);
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
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function alertConfirm()
    {
        $message  = '<b>Name</b> : '.$this->Cust->name."<br>";
        $message .= '<b>Introducer</b> : '.$this->CustIntroducer->name."<br>";
        $message .= '<b>Register Fee</b> : RM'.$this->applymember->register_fee."<br>";
        $message .= '<b>Share Fee</b> : RM'.$this->applymember->share_fee."<br>";
        $message .= '<b>Contribution Fee</b> : RM'.$this->applymember->contribution_fee."<br>";
        $message .= '<b>Total Fee</b> : RM'.$this->applymember->total_fee."<br>";

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
            'family'      => $this->Family,
            'introducer'  => $this->introducer,
            'employer'    => $this->Employer,
            'address'     => $this->CustAddress,
            'emp address' => $this->EmployAddress,
            'fam address' => $this->FamilyAddress,
            'address fams'=> $this->CustFamily->address()->firstOrCreate(),
        ]);
    }

    public function render()
    {
        return view('livewire.page.application.membership.new-membership')->extends('layouts.head');
    }

}