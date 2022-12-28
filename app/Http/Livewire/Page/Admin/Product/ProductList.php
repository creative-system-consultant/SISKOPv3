<?php

namespace App\Http\Livewire\Page\Admin\Product;

use Livewire\Component;
use App\Models\AccountProduct;
use App\Models\Coop;
use App\Models\User;

class ProductList extends Component
{

    public Coop $Coop;
    public User $User;
    public $Product;
    public $max_active;

    protected $rules = [
        'max_active.value'    => ['required'],
    ];

    public function mount()
    {
        $this->User = User::find(Auth()->user()->id);
        $coop_id = $this->User->coop_id;
        $this->Coop = Coop::find($coop_id);
        $this->Product = AccountProduct::where([['coop_id', $coop_id]])->get();
        $this->max_active = $this->Coop->rules()->firstOrCreate([
            'name'  => 'max_active'
        ],[
            'ruleable_name' => 'Coop',
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
