<?php

namespace App\Http\Livewire\Page\Application\ApplyFinancing;

use Livewire\Component;
use App\Models\AccountProduct;
use App\Models\User;

class FinancingList extends Component
{
    public User $User;
    public $Products;

    public function mount()
    {
        $this->User = User::find(Auth()->User()->id);
        $this->Products = AccountProduct::where('client_id', $this->User->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.application.apply-financing.financing-list')->extends('layouts.head');
    }
}