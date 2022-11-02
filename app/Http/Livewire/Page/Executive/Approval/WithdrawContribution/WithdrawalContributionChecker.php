<?php

namespace App\Http\Livewire\Page\Executive\Approval\WithdrawContribution;

use App\Models\Ref\RefBank;
use App\Models\Contribution;
use Livewire\Component;

class WithdrawalContributionChecker extends Component
{
    public $checker;
    public $bank;

    public function next()
    {
        return redirect()->route('withdrawal.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
       $this->checker = Contribution::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->checker->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.withdrawContribution.withdrawal-contribution-checker')->extends('layouts.head');
    }
}
