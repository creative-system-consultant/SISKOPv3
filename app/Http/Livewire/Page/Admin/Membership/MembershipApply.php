<?php

namespace App\Http\Livewire\Page\Admin\Membership;

use App\Models\Address;
use App\Models\ApplyMembership;
use App\Models\Customer;
use App\Models\CustEmployer;
use App\Models\CustFamily;
use App\Models\introducer;
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

class MembershipApply extends Component
{

    use WithFileUploads;
    public Membership $member;
    public ApplyMembership $applymember;
    public Customer $Cust;
    public Customer $CustFamily;
    public Customer $introducer;
    public CustEmployer $Employer;
    public CustFamily $Family;
    public Address $CustAddress;
    public Address $EmployAddress;
    public Address $FamilyAddress;
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
        'CustFamily.email'                   => 'required',
        'CustFamily.mobile_num'              => 'required',
        'introducer.name'                    => 'required',
        'introducer.icno'                    => 'nullable',
        'introducer.email'                   => 'nullable',
        'introducer.mbr_no'                  => 'nullable',
        'search'                             => 'required|numeric|digits:12',
        'applymember.register_fee'           => 'required|gt:50|numeric',
        'applymember.share_fee'              => 'required|gt:50|numeric',
        'applymember.contribution_fee'       => 'required|gt:50|numeric',
        'applymember.total_fee'              => 'required|numeric',

    ];

    public function next()
    {
        //dd($this->Cust->marital_id);
        $this->validate();

        if ($this->numpage == 3){
            $this->applymember->save();
            $this->totalfee();
            $this->render();
        }

        if ($this->numpage == 4){
            $this->fileupload();
            $this->render();
        }

        if ($this->numpage < 5){
            $this->numpage++;
        }

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
            $this->introducer = Customer::where('icno', $this->search)->first();
        }
        else {
            $this->introducer = new Customer;
        }
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
        $this->birthdate  = $tempday.'-'.$tempmonth.'-'.$tempyear;
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

    // public function marital()
    // {
    //     $this->Cust->marital_id;
    //     $this->Cust->relationship_id;
    //     $this->Cust->gender_id;

    //     if ($this->Cust->marital_id == 2 && $this->Cust->gender_id == 1)    //married and male
    //     {
    //            $this->Cust->relationship_id = 2;
    //     }
    //     elseif($this->Cust->marital_id == 2 && $this->Cust->gender_id == 2) //married and female
    //     {
    //         $this->Cust->relationship_id = 1;
    //     }
    //     else                                                                //single
    //     {
    //         $this->Cust->relationship_id = 5;
    //     }
    // }

    public function mount()
    {
        $user = auth()->user();
        $this->Cust              = Customer::where([['icno', $user->icno],['coop_id', $user->coop_id]])->first();
        $this->Cust->birthdate   = $this->birthdate();
        $this->Cust->gender_id   = $this->gender();
        $this->CustAddress       = $this->Cust->Address()->firstOrCreate();
        $this->Family            = CustFamily::firstOrCreate(['cust_id' => $this->Cust->id, 'relationship_id' => 5]);
        $this->FamilyAddress     = $this->Family->Address()->firstOrCreate();

        if ($this->Family->family_id != NULL){
            $this->CustFamily = Customer::find($this->Family->family_id);
        } else {
            $this->CustFamily = new Customer;
        }

        $this->member            = Membership::where('coop_id', $user->coop_id)->first();
        $this->field             = MembershipField::where('membership_id', $this->member->id)->get();
        $this->document          = MembershipDocument::where('membership_id', $this->member->id)->get();
        $introducer              = introducer::where('coop_id', $user->coop_id)->first();
        if ($introducer != NULL){
            $this->introducer    = Customer::find($introducer->intro_cust_id);
            $this->search        = $this->introducer->icno;
        }
        $this->applymember       = ApplyMembership::firstOrCreate(['cust_id' => $this->Cust->id, 'coop_id' => $user->coop_id],);

        $this->Employer          = CustEmployer::firstOrCreate(['cust_id' => $this->Cust->id],);
        $this->EmployAddress     = $this->Employer->Address()->firstOrCreate();

        $this->title_id          = RefCustTitle::all();
        $this->education_id      = RefEducation::all();
        $this->gender_id         = RefGender::where('id', $this->Cust->gender_id)->get();
        $this->marital_id        = RefMarital::all();
        $this->relationship      = RefRelationship::whereIn('id', [1,2,5,6])->get();
        $this->race_id           = RefRace::all();
        $this->state_id          = RefState::all();

        // if ($this->Cust->marital_id == 2){
        //     $married = TRUE;
        //     if($this->Cust->gender_id ==1 ){
        //         $family = 2;
        //     } else {
        //         $family = 1;
        //     }
        // } else {
        //     $married = FALSE;
        //     $family = 5;
        // }


    }

    public function fileupload()
    {
        $user = auth()->user();
        $customers = Customer::where('icno', $user->icno)->first();

        if($this->online_file){
            $filepath = 'Files/'.$customers->id.'/membership/IC_Photo'.'.'.$this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership/IC//',$this->online_file, 'IC_Photo'.'.'.$this->online_file->extension());

            $this->Cust->files()->updateOrCreate([
                'filename' => 'IC_Photo',
                'filedesc' => 'IC_Photo',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file2){
            $filepath = 'Files/'.$customers->id.'/membership/WorkerCard'.'.'.$this->online_file2->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership/WorkerCard//',$this->online_file2, 'WorkerCard'.'.'.$this->online_file2->extension());

            $this->Cust->files()->updateOrCreate([
                'filename' => 'WorkerCard',
                'filedesc' => 'WorkerCard',
                'filetype' => $this->online_file2->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file3){
            $filepath = 'Files/'.$customers->id.'/membership/Paycheck'.'.'.$this->online_file3->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership/Paycheck//',$this->online_file3, 'Paycheck'.'.'.$this->online_file3->extension());

            $this->Cust->files()->updateOrCreate([
                'filename' => 'Paycheck',
                'filedesc' => 'Paycheck',
                'filetype' => $this->online_file3->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->online_file4){
            $filepath = 'Files/'.$customers->id.'/membership/LastMonthPaycheck'.'.'.$this->online_file4->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $customers->id. '/membership/LastMonthPaycheck//',$this->online_file4, 'LastMonthPaycheck'.'.'.$this->online_file4->extension());

            $this->Cust->files()->updateOrCreate([
                'filename' => 'LastMonthPaycheck',
                'filedesc' => 'LastMonthPaycheck',
                'filetype' => $this->online_file4->extension(),
                'filepath' => $filepath,
            ]);
        };
    }

    public function totalfee()
    {
        $this->applymember->update([
            'total_fee' => $this->applymember->register_fee + $this->applymember->share_fee + $this->applymember->contribution_fee,
        ]);
    }

    public function submit()
    {
        $user = auth()->user();
        $customers = Customer::where('icno', $user->icno)->first();

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
            'coop_id'       => $user->coop_id,
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
        $this->validate();
        $message  = '<b>Name</b> : '.$this->Cust->name."<br>";
        $message .= '<b>Introducer</b> : '.$this->introducer->name."<br>";
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

    public function render()
    {
        return view('livewire.page.admin.membership.membership-apply')->extends('layouts.head');
    }

}