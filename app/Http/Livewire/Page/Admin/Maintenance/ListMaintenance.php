<?php

namespace App\Http\Livewire\Page\Admin\Maintenance;

use Livewire\Component;

class ListMaintenance extends Component
{
    public function render()
    {
        return view('livewire.page.admin.maintenance.list-maintenance')->extends('layouts.head');
    }
}
