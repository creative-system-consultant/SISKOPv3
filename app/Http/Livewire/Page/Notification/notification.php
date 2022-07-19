<?php

namespace App\Http\Livewire\Page\Notification;

use App\Models\ApplySpecialAid;
use App\Models\Customer;
use Livewire\Component;

class notification extends Component
{
    public $notifyAid;

    public function mount()
    {
        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();
        
        $this->specialAid = ApplySpecialAid::where('cust_id', $customer->id)->first();   
    }
    
    public function render()
    {
        return view('livewire.page.notification.notification')->extends('layouts.head');
    }
}
