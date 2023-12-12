<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;

class MaritalList extends Component
{

    public $marital;

    public function mount()
    {
        $this->marital = RefMarital::where('client_id', auth()->user()->client_id)->get();
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
        return view ('livewire.admin.maintenance.marital.index')->extends('layouts.head');
    }

}