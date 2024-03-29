<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Race;

use Livewire\Component;
use App\Models\Ref\RefRace;

class RaceList extends Component
{

    public $race;

    public function mount()
    {
        $this->race = RefRace::where('client_id', auth()->user()->client_id)->get();
    }

    public function delete($id)
    {
        $data = RefRace::find($id);
        $data->delete();

        session()->flash('message', 'Race Deleted');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('race.list');
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.race.index')->extends('layouts.head');
    }

}