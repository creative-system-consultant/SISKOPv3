<?php

namespace App\Http\Livewire\Page\Product;

use Livewire\Component;
use App\Models\AccountProduct;

class ProductList extends Component
{

    public $Product;
    
    public function mount()
    {
        $this->Product = AccountProduct::all();
    }

    public function render()
    {
        return view('livewire.page.product.productlist')->extends('layouts.head');
    }
}
