<?php

namespace App\Http\Livewire\Admin\Maintenance\Coop;

use Livewire\Component;

class CoopCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.maintenance.coop.create')->extends('layouts.head');
    }
}
