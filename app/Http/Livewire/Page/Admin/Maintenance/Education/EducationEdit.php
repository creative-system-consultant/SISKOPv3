<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Education;

use Livewire\Component;
use App\Models\Ref\RefEducation;

class EducationEdit extends Component
{
    public $edu_description;
    public $edu_code;
    public $edu_status;
    public $education;

    public function submit($id)
    {
        $this->validate([
            'edu_description' => ['required', 'string'],
            'edu_code'        => ['required', 'string'],
        ]);

        $education = RefEducation::where('id', $id)->first();

        $education->update([
            'description'     => trim(strtoupper($this->edu_description)),
            'code'            => trim(strtoupper($this->edu_code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
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
        return view ('livewire.admin.maintenance.education.edit')->extends('layouts.head');
    }
}