<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.page.home')->extends('layouts.head');
    }
}
