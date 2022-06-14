<?php

namespace App\Http\Livewire\Page\Profile;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.page.profile.index')->extends('layouts.head');
    }
}
