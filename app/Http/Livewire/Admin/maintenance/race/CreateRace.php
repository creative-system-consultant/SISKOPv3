<?php

namespace App\Http\Livewire\Admin\maintenance\race;

use Livewire\Component;
use App\Models\Ref\RefRace;

class CreateRace extends Component
{
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
            'status'      => $this->race_status == true ? '1' : '0',
            'created_at'  => now(),
            'created_by'  => Auth()->user()->name,
        ]);

        session()->flash('message', 'Race Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('race.list');
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.race.create')->extends('layouts.head');
    }
}
