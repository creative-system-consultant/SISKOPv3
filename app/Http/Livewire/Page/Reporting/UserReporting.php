<?php

namespace App\Http\Livewire\Page\Reporting;

use Livewire\Component;

class UserReporting extends Component
{
    public function render()
    {
        return view('livewire.page.reporting.user-reporting')->extends('layouts.head');
    }
}
