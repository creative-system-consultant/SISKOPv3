<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\State;

use Livewire\Component;
use App\Models\Ref\RefState;

class StateList extends Component
{
    public $RefState;

    public function mount()
    {
        $this->RefState = RefState::all();
    }

    public function delete($id)
    {
        $data=RefState::find($id);
        $data->delete();

        session()->flash('message', 'State Record Deleted');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('state.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.state')->extends('layouts.head');
    }
}
