<?php

namespace App\Http\Livewire\Page\Executive\Customer;

use App\Models\Coop;
use App\Models\CustCustomField;
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
    public Customer $Cust;
    public Coop $Coop;
    public $title_id;
    public $education;
    public $gender;
    public $marital;
    public $race;
    public $language;
    public $country;
    public $Fname  = [];
    public $Flabel = [];
    public $Ftype  = [];
    public $Fvalue = [];
    protected $rules=[
        'Cust.name'         =>'required',
        'Cust.icno'         =>'required',
        'Cust.birthdate'    =>'required',
        'Cust.birthplace'   =>'required',
        'Cust.birthdate'    =>'required',
        'Cust.title_id'     =>'required',
        'Cust.education_id' =>'required',
        'Cust.gender_id'    =>'required',
        'Cust.marital_id'   =>'required',
        'Cust.race_id'      =>'required',
        'Cust.language_id'  =>'required',
        'Cust.country_id'   =>'required',
    ];

    public function submit()
    {
        $this->Cust->update([
            'name'                => $this->Cust['name'],
            'icno'                => $this->Cust['icno'],
            'birthdate'           => $this->Cust['birthdate'],
            'birthplace'          => $this->Cust['birthplace'],
            'title_id'            => $this->Cust['title_id'],
            'education_id'        => $this->Cust['education_id'],
            'gender_id'           => $this->Cust['gender_id'],
            'marital_id'          => $this->Cust['marital_id'],
            'race_id'             => $this->Cust['race_id'],
            'language_id'         => $this->Cust['language_id'],
            'country_id'          => $this->Cust['country_id'],
        ]);

        foreach ($this->Fname as $key => $value) {
            $field = CustCustomField::updateOrCreate([
                'fieldable_type'    => get_class($this->Cust),
                'fieldable_id'      => $this->Cust->id,
                'name'              => $value,
            ],[
                'label'     => $this->Flabel[$key],
                'type'      => $this->Ftype[$key],
                'value'     => $this->Fvalue[$key],
            ]);
        }

        session()->flash('message', 'Profile Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('customer.search');
    }

    public function mount($uuid = NULL)
    {
        $this->Coop             = Coop::find(auth()->user()->coop_id);
        $this->Cust             = Customer::where('uuid', $uuid)->first();
        $this->title            = RefCustTitle::all();
        $this->education        = RefEducation::all();
        $this->gender           = RefGender::all();
        $this->marital          = RefMarital::all();
        $this->race             = RefRace::all();
        $this->country          = RefCountry::all();
        //$this->language         = RefLanguage::all();

        foreach ($this->Coop->fields as $key => $value) {
            $this->Fname[$key]  = $value->name;
            $this->Flabel[$key] = $value->label;
            $this->Ftype[$key]  = $value->type;
            $this->Fvalue[$key] = $this->Cust->field_value($value->name);
        }
    }

    public function render()
    {
        return view('livewire.page.executive.customers.edit')->extends('layouts.head');
    }
}