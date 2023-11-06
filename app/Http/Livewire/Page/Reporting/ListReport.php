<?php

namespace App\Http\Livewire\Page\Reporting;

use Livewire\Component;

class ListReport extends Component
{
    public function render()
    {
        return view('livewire.page.reporting.list-report')->extends('layouts.head');
    }
}
