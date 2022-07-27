<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Contribution;
use Livewire\Component;

class ContributionChecker extends Component
{
    public $checker;

    public function next()
    {
        return redirect()->route('contribution.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
       $this->checker = Contribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-checker')->extends('layouts.head');
    }
}
