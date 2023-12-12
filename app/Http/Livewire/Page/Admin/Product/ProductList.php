<?php

namespace App\Http\Livewire\Page\Admin\Product;

use Livewire\Component;
use App\Models\AccountProduct;
use App\Models\Client;
use App\Models\User;

class ProductList extends Component
{

    public Client $Coop;
    public User $User;
    public $Product;
    public $max_active;

    protected $rules = [
        'max_active.value'    => ['required'],
    ];

    public function mount()
    {
        $this->User = User::find(Auth()->user()->id);
        $client_id = $this->User->client_id;
        $this->Coop = Client::find($client_id);
        $this->Product = AccountProduct::where([['client_id', $client_id]])->get();
        $this->max_active = $this->Coop->rules()->firstOrCreate([
            'name'  => 'max_active'
        ],[
            'ruleable_name' => 'Client',
            'value'         => '0'
        ]);
    }

    public function submit()
    {
        $this->max_active->save();
    }

    public function render()
    {
        return view('livewire.page.admin.product.list')->extends('layouts.head');
    }
}
