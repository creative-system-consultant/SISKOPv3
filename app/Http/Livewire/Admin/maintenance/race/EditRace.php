<?php

namespace App\Http\Livewire\Admin\maintenance\race;

use App\Models\Ref\RefRace;
use Livewire\Component;

class EditRace extends Component
{
    public $race_description;
    public $race_code;
    public $race_status;
    public $race;

    public function submit($id)
    {
        $this->validate([
            'race_description' => ['required', 'string'],
            'race_code'        => ['required', 'string'],
        ]);

        $race = RefRace::where('id', $id)->first(); 

        $race->update([
            'description' => trim(strtoupper($this->race_description)),
            'code'        => trim(strtoupper($this->race_code)),
            'status'      => $this->race_status == true ? '1' : '0',
            'updated_at'  => now(),
            'updated_by'  => Auth()->user()->name,
        ]);

        session()->flash('message', 'Race Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('race.list'); 
    }

    public function load($id)
    {
        $race = RefRace::where('id', $id)->first();          

        $this->race_description    = $race->description; 
        $this->race_code           = $race->code;
        $this->race_status         = $race->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->race = RefRace::where('id', $id)->first();

        $this->load($id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.race.edit')->extends('layouts.head');
    }
}