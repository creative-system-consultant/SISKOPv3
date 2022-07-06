<?php

namespace App\Http\Livewire\Admin\Maintenance\gender;

use Livewire\Component;
use App\Models\Ref\RefGender;

class gender extends Component
{
    public $RefGender;

    public function mount()
    {
        $this->RefGender = RefGender::all();
    }

    public function delete($id)
    {
        $data=RefGender::find($id);
        $data->delete();

        session()->flash('message', 'Gender Record Deleted');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('gender.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender')->extends('layouts.head');
    }
}

