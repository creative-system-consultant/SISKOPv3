<?php

namespace App\Http\Livewire\Admin\SpecialAid;

use App\Models\SpecialAid;
use Livewire\Component;

class ListSpecialAid extends Component
{
    public $specialAids;

    public function mount()
    {
        $user = Auth()->user();
        $this->specialAids = SpecialAid::where('coop_id', $user->coop_id)->withTrashed()->get();
    }

    public function render()
    {
        return view('livewire.list-special-aid')->extends('layouts.head');
    }
}
