<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Education;

use Livewire\Component;
use App\Models\Ref\RefEducation;

class EducationEdit extends Component
{
    public RefEducation $education;

    protected $rules = [
        'education.description' => "required|max:255",
        'education.code'        => "required|max:255",
        'education.status'      => "",
    ];

    public function submit()
    {
        $this->education->status = $this->education->status ? '1' : '0';
        $this->education->save();

        session()->flash('message', 'Education Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('education.list');
    }

    public function mount($id)
    {
        $this->education = RefEducation::find($id);
        $this->education->status = $this->education->status ? TRUE : FALSE;
    }

    public function deb()
    {
        dd([
            'education' => $this->education,
        ]);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.education.edit')->extends('layouts.head');
    }
}