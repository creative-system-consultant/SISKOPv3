<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\State;

use App\Models\Ref\RefState;
use App\Models\User;
use Livewire\Component;

class StateCreate extends Component
{
    public User $User;
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
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'client_id'         => $this->User->client_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'State Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('state.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.statecreate')->extends('layouts.head');
    }
}