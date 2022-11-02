<?php

namespace App\Http\Livewire\Page\Executive\Approval\WithdrawContribution;

use App\Models\Ref\RefBank;
use App\Models\Contribution;
use Livewire\Component;

class WithdrawalContributionCommittee extends Component
{
    public $committee;
    public $bank;

    public function next()
    {
        return redirect()->route('withdrawal.approval', $this->committee->uuid);
    }

    public function mount($uuid)
    {
       $this->committee = Contribution::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->committee->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.withdrawContribution.withdrawal-contribution-committee')->extends('layouts.head');
    }
}
