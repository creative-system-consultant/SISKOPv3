<?php

namespace App\Http\Livewire\Page\Executive\Approval\Share;

use App\Models\Share;
use Livewire\Component;

class ShareCommittee extends Component
{
    public $committee;

    public function next()
    {
        return redirect()->route('share.approval', $this->committee->uuid);
    }

    public function mount($uuid)
    {
       $this->committee = Share::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-committee')->extends('layouts.head');
    }
}
