<?php

namespace App\Http\Livewire\Admin\Maintenance\state;

use App\Models\Ref\RefState;
use Livewire\Component;

class statecreate extends Component
{
    public $description;
    public $code;
    public $status;
    public $RefState;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $RefState = RefState::create([
            'description'       => $this->description,
            'code'              => $this->code,
            'status'            => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'State Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('state');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.statecreate')->extends('layouts.head');
    }
}