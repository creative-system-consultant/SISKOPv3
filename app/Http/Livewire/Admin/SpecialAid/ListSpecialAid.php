<?php

namespace App\Http\Livewire\Admin\SpecialAid;

use App\Models\SpecialAid;
use Livewire\Component;

class ListSpecialAid extends Component
{
    public $specialAids;

    public function mount()
    {
        $this->specialAids = SpecialAid::all();
    }

    public function render()
    {
        return view('livewire.list-special-aid')->extends('layouts.head');
    }
}
