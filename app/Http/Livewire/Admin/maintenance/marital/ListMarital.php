<?php

namespace App\Http\Livewire\Admin\maintenance\marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;

class ListMarital extends Component
{

    public $marital;

    public function mount()
    {
        $this->marital = RefMarital::get();
    }

    public function delete($id)
    {
        $data = RefMarital::find($id);
        $data->delete();

        session()->flash('message', 'Marital Deleted');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('marital.list');
    }

    public function render()
    {
        return view ('maintenance.marital.index')->extends('layouts.head');
    }

}