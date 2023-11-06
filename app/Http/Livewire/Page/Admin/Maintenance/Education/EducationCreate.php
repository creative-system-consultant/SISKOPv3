<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Education;

use App\Models\Ref\RefEducation;
use App\Models\User;
use Livewire\Component;

class EducationCreate extends Component
{
    public User $User;
    public $edu_description;
    public $edu_code;
    public $edu_status;
    public $education;

    public function submit()
    {
        $this->validate([
            'edu_description' => ['required', 'string'],
            'edu_code'        => ['required', 'string'],
        ]);

        $education = RefEducation::create([
            'description' => trim(strtoupper($this->edu_description)),
            'code'        => trim(strtoupper($this->edu_code)),
            'client_id'     => $this->User->client_id,
            'status'      => $this->edu_status == true ? '1' : '0',
            'created_at'  => now(),
            'created_by'  => Auth()->user()->name,
        ]);

        session()->flash('message', 'Education Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('education.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.education.create')->extends('layouts.head');
    }
}
