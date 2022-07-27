<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class SellShareChecker extends Component
{
    public $checker;
    public $banks;

    public function next()
    {
        return redirect()->route('sellShare.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
       $this->checker = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->checker->coop_id)->get(); 
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-checker')->extends('layouts.head');
    }
}
