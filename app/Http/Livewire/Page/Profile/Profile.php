<?php

namespace App\Http\Livewire\Page\Profile;

use App\Models\CustEmployer;
use App\Models\CustFamily;
use App\Models\Customer;
use App\Models\FmsAddress;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefReligion;
use App\Models\Ref\RefState;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    public User $User;
    public $Employer, $EmployerC10, $FmsCust, $FmsCustC10, $FmsAddressCust, $FmsAddressCustC10, $FmsAddressEmployer, $FmsAddressEmployerC10, $FmsCustFamily, $FmsCustFamilyC10, $state_id;
    public $mail_flag, $mail_flag_employer;
    public $race_id, $religion_id, $relationship;

    protected $rules = [
        'FmsCust.name'     => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'FmsCust.identity_no'     => 'required|numeric|digits:12',
        'FmsCust.phone' => ['required', 'regex:/^\d{7,11}$/'],
        'FmsCust.email'    => 'required|email',



        'Employer.name'     => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'Employer.department'     => ['required', 'string'],
        'Employer.position' => ['required', 'string'],
        'Employer.office_num'    => ['required', 'regex:/^\d{7,11}$/'],
        'Employer.salary'    => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],



        'FmsAddressCust.address1'     => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'FmsAddressCust.address2'     => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'FmsAddressCust.address3' => 'nullable',
        'FmsAddressCust.town'    => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'FmsAddressCust.postcode'    => 'required|digits:5',
        'FmsAddressCust.state_id'    => 'required',
        'mail_flag'                          => 'nullable',
        'mail_flag_employer'                 => 'nullable',


        'FmsAddressEmployer.address1'     => ['required', 'string'],
        'FmsAddressEmployer.address2'     => ['required', 'string'],
        'FmsAddressEmployer.address3' => 'nullable',
        'FmsAddressEmployer.town'    => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&().]+$/'],
        'FmsAddressEmployer.postcode'    => 'required|digits:5',
        'FmsAddressEmployer.state_id'    => 'required',


        'FmsCustFamily.name'                    => ['required', 'regex:/^[A-Za-z @\/-]+$/'],
        'FmsCustFamily.identity_no'             => 'required|numeric|digits:12',
        'FmsCustFamily.email'                   => ['required', 'email:rfc', 'regex:/^[\w\.-]+@[\w\.-]+\.\w+$/'],
        'FmsCustFamily.phone_no'                => ['required', 'regex:/^\d{7,11}$/'],
        'FmsCustFamily.relation_id'             => 'required',
        'FmsCustFamily.race_id'                 => 'required',
        'FmsCustFamily.religion_id'             => 'required',
        'FmsCustFamily.employer_name'           => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&()]+$/'],
        'FmsCustFamily.work_post'               => ['required', 'regex:/^[A-Za-z0-9 \-\/@,&()]+$/'],
        'FmsCustFamily.salary'                  =>  ['required', 'regex:/^\d+(\.\d{1,2})?$/'],


    ];

    public function submit()
    {
        $this->validate();
        if (!($this->mail_flag_employer == 1 && $this->mail_flag == 1) && !($this->mail_flag_employer == 0 && $this->mail_flag == 0)) {

            //Update Current Client and Client 10 Customer Data
            $this->FmsCustC10->name = $this->FmsCust->name;
            $this->FmsCustC10->phone = $this->FmsCust->phone;
            $this->FmsCustC10->email = $this->FmsCust->email;
            $this->FmsCustC10->save();
            $this->FmsCust->save();

            if ($this->mail_flag == 1) {
                $this->FmsAddressCust->mail_flag = 1;
                $this->FmsAddressEmployer->mail_flag = NULL;
                $this->FmsAddressCustC10->mail_flag = 1;
                $this->FmsAddressEmployerC10->mail_flag = NULL;
            }
            if ($this->mail_flag_employer == 1) {
                $this->FmsAddressEmployer->mail_flag = 1;
                $this->FmsAddressCust->mail_flag = NULL;
                $this->FmsAddressEmployerC10->mail_flag = 1;
                $this->FmsAddressCustC10->mail_flag = NULL;
            }

            //Update Current Client and Client 10 Employer Data
            $this->EmployerC10->name = $this->Employer->name;
            $this->EmployerC10->department = $this->Employer->department;
            $this->EmployerC10->position = $this->Employer->position;
            $this->EmployerC10->office_num = $this->Employer->office_num;
            $this->EmployerC10->salary = $this->Employer->salary;
            $this->EmployerC10->save();
            $this->Employer->save();

            //Update Current Client and Client 10 Customer Address Data
            $this->FmsAddressCustC10->address1 = $this->FmsAddressCust->address1;
            $this->FmsAddressCustC10->address2 = $this->FmsAddressCust->address2;
            $this->FmsAddressCustC10->address3 = $this->FmsAddressCust->address3;
            $this->FmsAddressCustC10->town = $this->FmsAddressCust->town;
            $this->FmsAddressCustC10->postcode = $this->FmsAddressCust->postcode;
            $this->FmsAddressCustC10->state_id = $this->FmsAddressCust->state_id;
            $this->FmsAddressCustC10->save();
            $this->FmsAddressCust->save();

            //Update Current Client and Client 10 Employer Address Data
            $this->FmsAddressEmployerC10->address1 = $this->FmsAddressEmployer->address1;
            $this->FmsAddressEmployerC10->address2 = $this->FmsAddressEmployer->address2;
            $this->FmsAddressEmployerC10->address3 = $this->FmsAddressEmployer->address3;
            $this->FmsAddressEmployerC10->town = $this->FmsAddressEmployer->town;
            $this->FmsAddressEmployerC10->postcode = $this->FmsAddressEmployer->postcode;
            $this->FmsAddressEmployerC10->state_id = $this->FmsAddressEmployer->state_id;
            $this->FmsAddressEmployerC10->save();
            $this->FmsAddressEmployer->save();

            //Update Current Client and Client 10 Customer Family Data
            $this->FmsCustFamilyC10->name = $this->FmsCustFamily->name;
            $this->FmsCustFamilyC10->identity_no = $this->FmsCustFamily->identity_no;
            $this->FmsCustFamilyC10->email = $this->FmsCustFamily->email;
            $this->FmsCustFamilyC10->phone_no = $this->FmsCustFamily->phone_no;
            $this->FmsCustFamilyC10->relation_id = $this->FmsCustFamily->relation_id;
            $this->FmsCustFamilyC10->race_id = $this->FmsCustFamily->race_id;
            $this->FmsCustFamilyC10->religion_id = $this->FmsCustFamily->religion_id;
            $this->FmsCustFamilyC10->employer_name = $this->FmsCustFamily->employer_name;
            $this->FmsCustFamilyC10->work_post = $this->FmsCustFamily->work_post;
            $this->FmsCustFamilyC10->salary = $this->FmsCustFamily->salary;
            $this->FmsCustFamilyC10->save();
            $this->FmsCustFamily->save();

            session()->flash('message', 'Profile Details Updated');
            session()->flash('time', 10000);
            session()->flash('success');
            session()->flash('title');

            return redirect()->route('Index');
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Warning!',
                'text'  => 'You must pick one Mailing Flag',
                'icon'  => 'warning',
                'showConfirmButton' => false,
                'timer' => 10000,
            ]);
        }
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->FmsCust = Customer::where('client_id', $this->User->client_id)->where('identity_no', $this->User->icno)->first();
        $this->FmsCustC10 = Customer::where('client_id', 10)->where('identity_no', $this->User->icno)->first();



        $this->Employer  = CustEmployer::where('client_id', $this->User->client_id)->where('cif_id', $this->FmsCust->id)->first();
        $this->FmsAddressCust = FmsAddress::where('client_id', $this->User->client_id)->where('cif_id', $this->FmsCust->id)->where('address_type_id', 2)->first();
        $this->FmsAddressEmployer = FmsAddress::where('client_id', $this->User->client_id)->where('cif_id', $this->FmsCust->id)->where('address_type_id', 3)->first();
        $this->FmsCustFamily = CustFamily::where('client_id', $this->User->client_id)->where('cif_id', $this->FmsCust->id)->first();

        $this->EmployerC10  = CustEmployer::where('client_id', 10)->where('cif_id', $this->FmsCust->id)->first();
        $this->FmsAddressCustC10 = FmsAddress::where('client_id', 10)->where('cif_id', $this->FmsCust->id)->where('address_type_id', 2)->first();
        $this->FmsAddressEmployerC10 = FmsAddress::where('client_id', 10)->where('cif_id', $this->FmsCust->id)->where('address_type_id', 3)->first();
        $this->FmsCustFamilyC10 = CustFamily::where('client_id', 10)->where('cif_id', $this->FmsCust->id)->first();


        $this->state_id          = RefState::where([['client_id', $this->User->client_id], ['status', '1']])->get();

        $this->race_id           = RefRace::where([['client_id', $this->User->client_id], ['status', '1']])->get();
        $this->religion_id       = RefReligion::where([['client_id', 1], ['status', '1']])->get();


        $this->mail_flag = $this->FmsAddressCust->mail_flag;
        $this->mail_flag_employer = $this->FmsAddressEmployer->mail_flag;
    }

    public function updatingMailFlag()
    {
        if ($this->mail_flag == 1) {
            $this->mail_flag = NULL;
        } else {
            $this->mail_flag = 1;
        }
    }
    public function updatingMailFlagEmployer()
    {
        if ($this->mail_flag_employer == 1) {
            $this->mail_flag_employer = NULL;
        } else {
            $this->mail_flag_employer = 1;
        }
    }

    public function render()
    {
        if (!$this->FmsCust->gender_code) {
            $this->relationship      = RefRelationship::where('client_id', $this->User->client_id)->get();
        } else {
            $this->relationship      = RefRelationship::GenderSpecificList($this->FmsCust->gender_code, $this->User->client_id);
        }
        return view('livewire.page.profile.profile')->extends('layouts.head');
    }
}
