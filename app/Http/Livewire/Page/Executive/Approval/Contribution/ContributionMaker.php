<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Contribution;
use Livewire\Component;

class ContributionMaker extends Component
{
    public $maker;

    public function next()
    {
        return redirect()->route('contribution.checker', $this->maker->uuid);
    }

    public function mount($uuid)
    {
       $this->maker = Contribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-maker')->extends('layouts.head');
    }
}
