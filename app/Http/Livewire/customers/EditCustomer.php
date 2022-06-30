<?php

namespace App\Http\Livewire\customers;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Ref\RefCustTitle;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefLangugage;
use App\Models\Ref\RefCountry;


class EditCustomer extends Component
{
        public Customer $cust;
        public $customers;
        public $name;
        public $icno;
        public $birthdate;
        public $birthplace;
        public $title_id;
        public $education_id;
        public $gender_id;
        public $marital_id;
        public $race_id;
        public $language_id;
        public $country_id;
        protected $rules=[
            'cust.name'         =>'required',
            'cust.icno'         =>'required',
            'cust.birthdate'    =>'required',
            'cust.birthplace'   =>'required',
            'cust.birthdate'    =>'required',
            'cust.title_id'     =>'required',
            'cust.education_id' =>'required',
            'cust.gender_id'    =>'required',
            'cust.marital_id'   =>'required',
            'cust.race_id'      =>'required',
            'cust.language_id'  =>'required',
            'cust.country_id'   =>'required',
        ];
        
        public function submit($id)
        {
        // $this->validate();

        $customers = Customer::where('id', $id)->first();
        
        $customers->update([
            'name'                => $this->cust['name'],
            'icno'                => $this->cust['icno'],
            'birthdate'           => $this->cust['birthdate'],
            'birthplace'          => $this->cust['birthplace'],
            'title_id'            => $this->cust['title_id'],
            'education_id'        => $this->cust['education_id'],
            'gender_id'           => $this->cust['gender_id'],
            'marital_id'          => $this->cust['marital_id'],
            'race_id'             => $this->cust['race_id'],
            'language_id'         => $this->cust['language_id'],
            'country_id'          => $this->cust['country_id'],

        ]);

        session()->flash('message', 'Profile Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('searchcustomer');
    }

    public function  loadUser($id)
    {
        $customers = Customer::where('id', $id)->first();
    }
    
    public function mount($id)
    {
        $this->cust             = Customer::where('id', $id)->first();
        $this->title_id         = RefCustTitle::all();
        $this->education_id     = RefEducation::all();
        $this->gender_id        = RefGender::all();
        $this->marital_id       = RefMarital::all();
        $this->race_id          = RefRace::all();
        // $this->language_id   = RefLanguage::all();
        $this->country_id       = RefCountry::all();
        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.customers.edit')->extends('layouts.head');
    }

}