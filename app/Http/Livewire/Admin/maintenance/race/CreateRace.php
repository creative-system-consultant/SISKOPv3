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
            'race_code'        => ['required'],
        ]);

        $race = RefRace::create([
            'description' => $this->race_description,
            'code'        => $this->race_code,
            'status'      => $this->race_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Race Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('race.list');
    }

    public function render()
    {
        return view ('maintenance.race.create')->extends('layouts.head');
    }
}
