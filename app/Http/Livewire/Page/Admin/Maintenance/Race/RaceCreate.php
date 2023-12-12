<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Race;

use Livewire\Component;
use App\Models\Ref\RefRace;
use App\Models\User;

class RaceCreate extends Component
{
    public User $User;
    public $race_description;
    public $race_code;
    public $race_status;
    public $race;

    public function submit()
    {
        $this->validate([
            'race_description' => ['required', 'string'],
            'race_code'        => ['required', 'string'],
        ]);

        $race = RefRace::create([
            'description' => trim(strtoupper($this->race_description)),
            'code'        => trim(strtoupper($this->race_code)),
            'client_id'   => $this->User->client_id,
            'status'      => $this->race_status == true ? '1' : '0',
            'created_at'  => now(),
            'created_by'  => Auth()->id(),
        ]);

        session()->flash('message', 'Race Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('race.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.race.create')->extends('layouts.head');
    }
}
