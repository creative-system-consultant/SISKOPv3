<?php

namespace App\Http\Livewire\Page\Admin\Maintenance;

use Livewire\Component;

class AddMaintenance extends Component
{
    public function render()
    {
        return view('livewire.page.admin.maintenance.add-maintenance')->extends('layouts.head');
    }
}
