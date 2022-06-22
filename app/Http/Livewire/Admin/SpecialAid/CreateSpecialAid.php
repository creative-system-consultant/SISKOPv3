<?php

namespace App\Http\Livewire\Admin\SpecialAid;

use App\Models\SpecialAid;
use Livewire\Component;

class CreateSpecialAid extends Component
{
    public $specialAid_name;
    public $enabled_apply_amt;
    public $default_apply_amount;
    public $specialAid;

    public function submit()
    {
        $this->validate([
            'specialAid_name'       => ['required', 'string'],
            'default_apply_amount'  => ['required', 'numeric'],
        ]);

        $specialAid = SpecialAid::create([
            'coop_id'            => 1,  
            'name'               => $this->specialAid_name,
            'apply_amt_enable'   => $this->enabled_apply_amt == true ? '1' : '0',
            'default_apply_amt'  => $this->default_apply_amount,
        ]);

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
