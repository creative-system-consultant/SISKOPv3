<?php

namespace App\Http\Livewire\customers;

use Livewire\Component;
use App\Models\Customer;


class SearchCustomer extends Component
{
    
    public $customers = [];
    public $searchby;
    public $search;
    // public $result;
    // public $cust;

    public function mount()
    {
        $this->customers = Customer::all();
    }

    public function search()
    {
        // $this->result = true;
        // $this->cust = false;

        // dd($this->search);
        $this->validate([
            'searchby'   => ['required'],
            'search'     => ['required', 'string'], 
        ]);
        

        $this->customers = Customer::where('name', 'like', '%' .$this->search. '%')
        ->orwhere('icno', 'like', '%' .$this->search. '%')->get();
        $this->render();
        
    }

    public function render()
    {
        return view('livewire.customers.search')->extends('layouts.head');
    }
}