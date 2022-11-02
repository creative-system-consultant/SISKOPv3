<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Contribution;
use Livewire\Component;

class ContributionApproval extends Component
{
    public $approve;

    public function submit()
    {
        session()->flash('message', 'Add contribution application has been successfully approved');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('application.list');
    }

    public function mount($uuid)
    {
       $this->approve = Contribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-approval')->extends('layouts.head');
    }
}
