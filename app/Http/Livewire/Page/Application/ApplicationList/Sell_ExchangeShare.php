<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\Share as ApplyShare;
use Livewire\Component;

class Sell_ExchangeShare extends Component
{
    public $sellShare,$custApply,$banks;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyShare::where('uuid', $uuid)->with('customer')->first();         
        $this->banks = RefBank::where('coop_id', $this->custApply->coop_id)->get(); 
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
