<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Contribution;
use Livewire\Component;

class ContributionCommittee extends Component
{
    public $committee;

    public function next()
    {
        return redirect()->route('contribution.approval', $this->committee->uuid);
    }

    public function mount($uuid)
    {
       $this->committee = Contribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-committee')->extends('layouts.head');
    }
}
