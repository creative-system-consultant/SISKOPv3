<?php

namespace App\Http\Livewire\Page\Executive\Approval\WithdrawContribution;

use App\Models\Ref\RefBank;
use App\Models\Contribution;
use Livewire\Component;

class WithdrawalContributionMaker extends Component
{
    public $maker;
    public $bank;

    public function next()
    {
        return redirect()->route('withdrawal.checker', $this->maker->uuid);
    }

    public function mount($uuid)
    {
       $this->maker = Contribution::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('coop_id', $this->maker->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.withdrawContribution.withdrawal-contribution-maker')->extends('layouts.head');
    }
}
