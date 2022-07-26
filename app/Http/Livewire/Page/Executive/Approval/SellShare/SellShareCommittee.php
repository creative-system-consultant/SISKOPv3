<?php

namespace App\Http\Livewire\Page\Executive\Approval\SellShare;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class SellShareCommittee extends Component
{
    public $committee;
    public $banks;

    public function next()
    {
        return redirect()->route('sellShare.approval', $this->committee->uuid);
    }

    public function mount($uuid)
    {
       $this->committee = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->committee->coop_id)->get(); 
    }

    public function render()
    {
        return view('livewire.page.executive.approval.sellShare.sell-share-committee')->extends('layouts.head');
    }
}
