<?php

namespace App\Http\Livewire\Page\Admin\SpecialAid;

use App\Models\SpecialAid;
use App\Models\SpecialAidField;
use Livewire\Component;

class EditSpecialAid extends Component
{
    public $field;
    public $specialAid_name;
    public $enabled_apply_amt;
    public $default_apply_amount;
    public $default_min_amount;
    public $default_max_amount;
    public $specialAid;
    public $start_date;
    public $end_date;
    public $Fname  = [''];
    public $Flabel = [''];
    public $Ftype  = [''];
    public $Fstatus = [''];
    public $Frequired = [''];
    public $Fuuid = [''];

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['remField'];

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

    public function createField()
    {
        $this->Fname[]  = '';
        $this->Flabel[] = '';
        $this->Ftype[]  = '';
    }

    public function alertDelete($uuid, $index)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure?',
            'uuid'      => $uuid,
            'index'     => $index,
        ]);
    }

    public function remField($uuid, $index)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $Fdelete = $specialAid->field()->where('uuid', $this->Fuuid[$index])->first();
        $Fdelete->delete();

        return redirect()->route('special_aid.edit', $uuid);
    }

    public function fieldStatus($uuid, $index)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $Fupdate = $specialAid->field()->where('uuid', $this->Fuuid[$index])->first();
        $Fupdate->update([
            'status' => $this->Fstatus[$index],
        ]);
    }


    public function fieldRequired($uuid, $index)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $updateF = $specialAid->field()->where('uuid', $this->Fuuid[$index])->first();
        $updateF->update([
            'required' => $this->Frequired[$index],
        ]);
    }

    public function submit($uuid)
    {
        // dd($this->start_date);
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $this->validate();

        $specialAid->update([
            'name'               => $this->specialAid_name,
            'apply_amt_enable'   => $this->enabled_apply_amt == true ? '1' : '0',
            'default_apply_amt'  => $this->default_apply_amount ?? NULL,
            'min_apply_amt'      => $this->default_min_amount ?? NULL,
            'max_apply_amt'      => $this->default_max_amount ?? NULL,
            'start_date'         => $this->start_date  ? $specialAid->start_date->format('Y-m-d') : NULL,
            'end_date'           => $this->end_date ? $specialAid->end_date->format('Y-m-d') : NULL,
        ]);

        foreach ($this->Fname as $index => $input) {
            if (($this->Fuuid[$index] ?? NULL) == NULL){
                $specialAid->field()->create([
                        'name'      => $this->Fname[$index],
                        'label'     => $this->Flabel[$index],
                        'type'      => $this->Ftype[$index] == '' ? 'string' : $this->Ftype[$index],
                ]);
            } else {
                $specialAid->field()->updateOrCreate([
                        'uuid'      =>  $this->Fuuid[$index],
                    ],[
                        'name'      => $this->Fname[$index],
                        'label'     => $this->Flabel[$index],
                        'type'      => $this->Ftype[$index]  == '' ? 'string' : $this->Ftype[$index],
                ]);
            }
        }

        session()->flash('message', 'Special Aid Updated');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special_aid.list');
    }

    public function  loadUser($uuid)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $this->specialAid_name      = $specialAid->name;
        $this->default_apply_amount = $specialAid->default_apply_amt;
        $this->default_min_amount   = $specialAid->min_apply_amt;
        $this->default_max_amount   = $specialAid->max_apply_amt;
        $this->enabled_apply_amt    = $specialAid->apply_amt_enable == true ? 'checked' : '';
        $this->start_date           = $specialAid?->start_date ? $specialAid->start_date->format('Y-m-d') : '';
        $this->end_date             = $specialAid?->end_date ? $specialAid->end_date->format('Y-m-d') : '';

        foreach ($specialAid->field as $index => $input) {
            $this->Flabel[$index]      = $input->label;
            $this->Fname[$index]       = $input->name;
            $this->Ftype[$index]       = $input->type;
            $this->Fuuid[$index]       = $input->uuid;
            $this->Fstatus[$index]     = $input->status   == '1' ? true : false;
            $this->Frequired[$index]   = $input->required == '1' ? true : false;
        }
    }

        public function mount($uuid)
    {
        $this->specialAid = SpecialAid::where('uuid', $uuid)->first();

        $this->field = new SpecialAidField;

        $this->loadUser($uuid);
    }

    public function render()
    {
        return view('livewire.page.admin.special-aid.edit-special-aid')->extends('layouts.head');
    }
}

