<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;

class GenderList extends Component
{
    public $RefGender;

    public function mount()
    {
        $this->RefGender = RefGender::where('client_id', auth()->user()->client_id)->get();
    }

    public function delete($id)
    {
        $data=RefGender::find($id);
        $data->delete();

        session()->flash('message', 'Gender Record Deleted');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('gender.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender')->extends('layouts.head');
    }
}

