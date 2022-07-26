<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class SellShareMaker extends Component
{
    public $maker;
    public $banks;

    public function next()
    {
        return redirect()->route('sellShare.checker', $this->maker->uuid);
    }

    public function mount($uuid)
    {
       $this->maker = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->maker->coop_id)->get(); 
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-maker')->extends('layouts.head');
    }
}
