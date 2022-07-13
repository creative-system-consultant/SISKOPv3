<?php

namespace App\Http\Livewire\Page\Executive\Customer;

use Livewire\Component;
use App\Models\Customer;


class SearchCustomer extends Component
{
    
    public $customers = [];
    public $searchby;
    public $search;

    public function mount()
    {
        // $this->customers = Customer::all();
    }

    public function search()
    {

        // dd($this->search);
        $this->validate([
            'searchby'   => ['required'],
            'search'     => ['required', 'string'], 
        ]);

        if ($this->searchby == 'name'){
            $this->customers = Customer::where('name', 'like', '%' .$this->search. '%')->get();
        }
        else if (($this->searchby == 'icno') ){
            $this->customers = Customer::where('icno', 'like', '%' .$this->search. '%')->get();
        }
        else {
            [];
        }
        
    }

    public function render()
    {
        return view('livewire.customers.search')->extends('layouts.head');
    }
}