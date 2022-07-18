<?php

namespace App\Http\Livewire\Page\Admin\SpecialAid;

use App\Models\SpecialAid;
use App\Models\SpecialAidField;
use Livewire\Component;
use Request;

class CreateSpecialAid extends Component
{
    public $specialAid_name;
    public $enabled_apply_amt;
    public $default_apply_amount;
    public $default_min_amount;
    public $default_max_amount;
    public $start_date;
    public $end_date;
    public $specialAid;
    public $field;
    public $Fname  = [''];
    public $Flabel = [''];
    public $Ftype  = [''];

    protected $rules = [
        'specialAid_name'       => ['required', 'string'],
        'default_apply_amount'  => ['nullable', 'numeric'],
        'default_min_amount'    => ['nullable', 'numeric'],
        'default_max_amount'    => ['nullable', 'numeric'],
        'Fname.*'               => ['required', 'min:4'],
        'Flabel.*'              => ['required', 'min:4'],
        'start_date'            => ['nullable', 'string'],
        'end_date'              => ['nullable', 'string'],
    ];

    protected $messages = [
        'specialAid_name.required'  => ':attribute field is required',
        'Fname.*.required'          => ':attribute field is required', 
        'Fname.*.min'               => ':attribute must be at least 4 characters',
        'Flabel.*.required'         => ':attribute is required',
        'Flabel.*.min'              => ':attribute must be at least 4 characters',
    ];

    protected $validationAttributes = [
        'specialAid_name'      => 'Name', 
        'Fname.*'              => 'Field Name', 
        'Flabel.*'             => 'Field Label',
    ];

    public function mount()
    {
        $this->field = new SpecialAidField;
    }

    public function addField()
    {
        $this->Fname[]  = '';
        $this->Flabel[] = '';
        $this->Ftype[]  = '';
    }

    public function remField($index)
    {
        unset($this->Fname[$index]);
        unset($this->Flabel[$index]);
        unset($this->Ftype[$index]);
        $this->Fname  = array_values($this->Fname);
        $this->Flabel = array_values($this->Flabel);
        $this->Ftype  = array_values($this->Ftype);
    }

    public function submit()
    {
        $user = Auth()->user();

        $this->validate();

        $specialAid = SpecialAid::create([
            'coop_id'            => $user->coop_id,  
            'name'               => ucwords($this->specialAid_name),
            'apply_amt_enable'   => $this->enabled_apply_amt == true ? '1' : '0',
            'default_apply_amt'  => $this->default_apply_amount ?? NULL,
            'min_apply_amt'      => $this->default_min_amount ?? NULL,
            'max_apply_amt'      => $this->default_max_amount ?? NULL,
            'start_date'         => $this->start_date ?? NULL,
            'end_date'           => $this->end_date ?? NULL,
        ]);

        foreach ($this->Fname as $index => $name) {
            $specialAid->field()->create([
                'name'      => $this->Fname[$index],
                'label'     => $this->Flabel[$index],
                'type'      => $this->Ftype[$index] ??= 'string',
            ]);
        }

        session()->flash('message', 'Special Aid Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special_aid.list');
    }

    public function render()
    {
        return view('livewire.page.admin.special-aid.create')->extends('layouts.head');
    }
}
