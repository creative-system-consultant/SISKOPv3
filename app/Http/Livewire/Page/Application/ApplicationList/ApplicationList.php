<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use Livewire\Component;

class ApplicationList extends Component
{
    public $setIndex = '0';

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.page.application.application-list.application-list')->extends('layouts.head');
    }
}
