<?php

namespace App\Http\Livewire\Page\Executive\Approval\Share;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class ShareMaker extends Component
{
    public $maker;
    public $banks;

    public function next()
    {
        return redirect()->route('share.checker', $this->maker->uuid);
    }

    public function mount($uuid)
    {
       $this->maker = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->maker->coop_id)->get(); 
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-maker')->extends('layouts.head');
    }
}
