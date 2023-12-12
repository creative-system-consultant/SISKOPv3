<?php

namespace App\Http\Livewire\Page\Application\ApplyClosedMembership;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.page.application.apply-closed-membership.index')->extends('layouts.head');
    }
}
