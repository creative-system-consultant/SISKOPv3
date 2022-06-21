<?php

namespace App\Http\Livewire\Page\Admin\Maintenance;

use Livewire\Component;

class EditMaintenance extends Component
{
    public function render()
    {
        return view('livewire.page.admin.maintenance.edit-maintenance')->extends('layouts.head');
    }
}
