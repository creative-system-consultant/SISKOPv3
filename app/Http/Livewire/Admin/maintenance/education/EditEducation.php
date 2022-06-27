<?php

namespace App\Http\Livewire\Admin\maintenance\education;

use Livewire\Component;
use App\Models\Ref\RefEducation;

class EditEducation extends Component
{
    public $edu_description;
    public $edu_code;
    public $edu_status;
    public $education;

    public function submit($id)
    {
        $this->validate([
            'edu_description' => ['required', 'string'],
            'edu_code'        => ['required'],
        ]);

        $education = RefEducation::where('id', $id)->first();

        $education->update([
            'description' => $this->edu_description,
            'code'        => $this->edu_code,
            'status'      => $this->edu_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Education Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('education.list'); 
    }

    public function load($id)
    {
        $education = RefEducation::where('id', $id)->first();          

        $this->edu_description    = $education->description; 
        $this->edu_code           = $education->code;
        $this->edu_status         = $education->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->education = RefEducation::where('id', $id)->first();

        $this->load($id);
    }

    public function render()
    {
        return view ('maintenance.education.edit')->extends('layouts.head');
    }
}