<?php

namespace App\Http\Livewire\Page\Profile;

use App\Models\CustEmployer;
use App\Models\Customer;
use App\Models\FmsAddress;
use App\Models\Ref\RefState;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    public User $User;
    public $Employer, $FmsCust, $FmsCustC10, $FmsAddressCust, $FmsAddressEmployer, $state_id;
    public $mail_flag, $mail_flag_employer;

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

    ];

    public function submit()
    {
        $this->validate();
        if (!($this->mail_flag_employer == 1 && $this->mail_flag == 1) && !($this->mail_flag_employer == 0 && $this->mail_flag == 0)) {

            $this->FmsCust->save();
            $this->FmsCustC10->name = $this->FmsCust->name;
            $this->FmsCustC10->phone = $this->FmsCust->phone;
            $this->FmsCustC10->email = $this->FmsCust->email;
            $this->FmsCustC10->save();
            $this->Employer->save();
            if ($this->mail_flag == 1) {
                $this->FmsAddressCust->mail_flag = 1;
                $this->FmsAddressEmployer->mail_flag = NULL;
            }
            if ($this->mail_flag_employer == 1) {
                $this->FmsAddressEmployer->mail_flag = 1;
                $this->FmsAddressCust->mail_flag = NULL;
            }
            $this->FmsAddressCust->save();
            $this->FmsAddressEmployer->save();

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
        $this->state_id          = RefState::where([['client_id', $this->User->client_id], ['status', '1']])->get();
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
        return view('livewire.page.profile.profile')->extends('layouts.head');
    }
}
