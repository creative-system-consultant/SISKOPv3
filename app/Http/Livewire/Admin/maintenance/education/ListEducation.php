<?php

namespace App\Http\Livewire\Admin\maintenance\education;

use Livewire\Component;

use App\Models\Ref\RefEducation;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ListEducation extends Component
{

    public $education;

    public function mount()
    {
        $this->education = RefEducation::get();
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