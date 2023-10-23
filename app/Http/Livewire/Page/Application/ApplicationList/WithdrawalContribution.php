<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class WithdrawalContribution extends Component
{
    public User $User;
    public $withdrawal;
    public $withdraw;
    public $bankName;
    public $banks;

    public function clearApplication()
    {
        $this->withdraw = NULL;
    }

    public function showApplication($uuid)
    {
        $this->withdraw = ApplyContribution::where('uuid', $uuid)->with('customer')->first();
        $this->bankName = RefBank::where('client_id', $this->User->client_id)->get();
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->withdrawal = ApplyContribution::where([['direction', 'withdraw'],['client_id', $this->User->client_id]])->orderBy('created_at','desc')->with('customer')->get();

        $this->banks = RefBank::where('client_id', $this->User->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.withdrawal-contribution');
    }
}
