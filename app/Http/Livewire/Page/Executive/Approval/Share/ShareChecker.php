<?php

namespace App\Http\Livewire\Page\Executive\Approval\Share;

use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class ShareChecker extends Component
{
    public $checker;

    public function next()
    {
        return redirect()->route('share.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
       $this->checker = Share::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-checker')->extends('layouts.head');
    }
}
