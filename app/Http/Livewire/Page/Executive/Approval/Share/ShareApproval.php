<?php

namespace App\Http\Livewire\Page\Executive\Approval\Share;

use App\Models\Share;
use Livewire\Component;

class ShareApproval extends Component
{
    public $approve;

    public function submit()
    {
        session()->flash('message', 'Share application has been successfully approved');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('application.list');
    }

    public function mount($uuid)
    {
       $this->approve = Share::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-approval')->extends('layouts.head');
    }
}
