<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;
use App\Models\User;

class MaritalCreate extends Component
{
    public User $User;
    public $marital_description;
    public $marital_code;
    public $marital_status;
    public $marital;

    public function submit()
    {
        $this->validate([
            'marital_description' => ['required', 'string'],
            'marital_code'        => ['required', 'string'],
        ]);

        $marital = RefMarital::create([
            'description' => trim(strtoupper($this->marital_description)),
            'code'        => trim(strtoupper($this->marital_code)),
            'client_id'   => $this->User->client_id,
            'status'      => $this->marital_status == true ? '1' : '0',
            'created_at'  => now(),
            'created_by'  => Auth()->id(),
        ]);

        session()->flash('message', 'Marital Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('marital.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.marital.create')->extends('layouts.head');
    }
}
