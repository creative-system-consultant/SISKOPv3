<?php

namespace App\Http\Livewire\Page\Application\ApplyFinancing;

use Livewire\Component;
use App\Models\AccountProduct;

class FinancingList extends Component
{
    public $Product;

    public function mount()
    {
        $this->Product = AccountProduct::all();
    }

    public function render()
    {
        return view('livewire.page.application.apply-financing.financing-list')->extends('layouts.head');
    }
}