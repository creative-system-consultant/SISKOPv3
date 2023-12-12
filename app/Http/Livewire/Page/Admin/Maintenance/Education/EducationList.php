<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Education;

use Livewire\Component;

use App\Models\Ref\RefEducation;
use SebastianBergmann\CodeUnit\FunctionUnit;

class EducationList extends Component
{

    public $education;

    public function mount()
    {
        $this->education = RefEducation::where('client_id', auth()->user()->client_id)->get();
    }

    public function delete($id)
    {
        $data = RefEducation::find($id);
        $data->delete();

        session()->flash('message', 'Education Deleted');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('education.list');
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.education.index')->extends('layouts.head');
    }

}