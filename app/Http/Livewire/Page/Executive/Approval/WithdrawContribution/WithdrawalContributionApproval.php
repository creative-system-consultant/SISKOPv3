<?php

namespace App\Http\Livewire\Page\Executive\Approval\WithdrawContribution;

use App\Models\Ref\RefBank;
use App\Models\Contribution;
use Livewire\Component;

class WithdrawalContributionApproval extends Component
{
    public $approve;
    public $bank;

    public function submit()
    {
        session()->flash('message', 'Withdrawal contribution application has been successfully approved');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('application.list');
    }

    public function mount($uuid)
    {
       $this->approve = Contribution::where('uuid', $uuid)->with('customer')->first();
       $this->banks = RefBank::where('client_id', $this->approve->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.withdrawContribution.withdrawal-contribution-approval')->extends('layouts.head');
    }
}
