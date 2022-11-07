<?php

namespace App\Http\Livewire\Page\Admin\Product;

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
        return view('livewire.page.admin.product.list')->extends('layouts.head');
    }
}
