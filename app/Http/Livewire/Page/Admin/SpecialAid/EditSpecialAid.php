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
    public $specialAid;

    public function submit($uuid)
    {
        $this->validate([
            'specialAid_name'       => ['required', 'string'],
            'default_apply_amount'  => ['required', 'numeric'],
        ]);

        $specialAid = SpecialAid::where('uuid', $uuid)->first();
        
        $specialAid->update([
            'name'               => $this->specialAid_name,
            'apply_amt_enable'   => $this->enabled_apply_amt == true ? '1' : '0',
            'default_apply_amt'  => $this->default_apply_amount,
        ]);

        session()->flash('message', 'Special Aid Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special_aid.list');
    }

    public function  loadUser($uuid)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();          

        $this->specialAid_name      = $specialAid->name;
        $this->default_apply_amount = $specialAid->default_apply_amt;
        $this->enabled_apply_amt    = $specialAid->apply_amt_enable == true ? 'checked' : '';
    }
    
    public function mount($uuid)
    {
        $user = Auth()->user();
        $this->specialAid = SpecialAid::where('uuid', $uuid)->first();
        $this->field = new SpecialAidField;

        $this->loadUser($uuid);
    }

    public function render()
    {
        return view('livewire.page.admin.special-aid.edit-special-aid')->extends('layouts.head');
    }
}
