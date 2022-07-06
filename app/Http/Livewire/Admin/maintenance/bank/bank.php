<?php

namespace App\Http\Livewire\Admin\Maintenance\Bank;

use Livewire\Component;
use App\Models\Ref\RefBank;

class bank extends Component
{
    public $RefBank;

    public function mount()
    {
        $this->RefBank = RefBank::all();
    }

    public function delete($id)
    {
        $data=RefBank::find($id);
        $data->delete();

        session()->flash('message', 'Bank Record Deleted');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('bank.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bank')->extends('layouts.head');
    }
}

