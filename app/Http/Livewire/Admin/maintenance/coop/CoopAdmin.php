<?php

namespace App\Http\Livewire\Admin\maintenance\coop;

use App\Models\Coop;
use Livewire\Component;
use App\Models\Ref\RefBank;

class CoopAdmin extends Component
{
    public $coops;

    public function mount()
    {
        $this->coops = Coop::withTrashed()->get();
    }

    public function delete($id)
    {
        $data=Coop::find($id);
        $data->delete();

        session()->flash('message', 'COOP Delete Success');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('CoopIndex');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.coop.index')->extends('layouts.head');
    }
}

