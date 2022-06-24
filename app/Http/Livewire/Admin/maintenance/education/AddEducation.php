<?php

namespace App\Http\Livewire\Admin\maintenance\education;

use App\Models\Ref\RefEducation;
use Livewire\Component;

class AddEducation extends Component
{
    public $edu_description;
    public $edu_code;
    public $edu_status;
    public $education;

    public function submit()
    {
        $this->validate([
            'edu_description' => ['required', 'string'],
            'edu_code'        => ['required'],
        ]);

        $education = RefEducation::create([
            'description' => $this->edu_description,
            'code'        => $this->edu_code,
            'status'      => $this->edu_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Education Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('education.list');
    }

    public function render()
    {
        return view ('maintenance.education.create')->extends('layouts.head');
    }
}
