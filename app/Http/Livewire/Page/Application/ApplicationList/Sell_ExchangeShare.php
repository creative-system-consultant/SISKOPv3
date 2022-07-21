<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\Share as ApplyShare;
use Livewire\Component;

class Sell_ExchangeShare extends Component
{
    public $sellShare;

    public function showApplication($uuid)
    {
        $custApply = ApplyShare::where('uuid', $uuid)->with('customer')->first();         
        $banks = RefBank::where('coop_id', $custApply->coop_id)->get();   

        return view('livewire.page.application.application-list.apply_sell_exchange_share', compact('custApply', 'banks'));
    }

    public function mount()    
    { 
        $this->sellShare = ApplyShare::where('direction', 'sell')->orWhere('direction', 'exchange')->orderBy('created_at','desc')->with('customer')->get();    
    }

    public function render()
    {
        return view('livewire.page.application.application-list.sell-exchange-share');
    }
}
