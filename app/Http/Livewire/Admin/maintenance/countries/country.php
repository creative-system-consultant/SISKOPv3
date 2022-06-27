<?php

namespace App\Http\Livewire\Admin\Maintenance\countries;

use Livewire\Component;
use App\Models\Ref\RefCountry;

class country extends Component
{
    public $RefCountry;

    public function mount()
    {
        $this->RefCountry = RefCountry::all();
    }

    public function delete($id)
    {
        $data=RefCountry::find($id);
        $data->delete();

        session()->flash('message', 'Country Record Deleted');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('country');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.countries.country')->extends('layouts.head');
    }
}

