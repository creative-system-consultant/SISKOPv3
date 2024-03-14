<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use Livewire\Component;
use Route;

class ApplicationList extends Component
{
    public $route;
    public $setIndex = '0';

    public function mount()
    {
        $this->route = Route::currentRouteName();
    }

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.page.application.application-list.application-list')->extends('layouts.head');
    }
}
