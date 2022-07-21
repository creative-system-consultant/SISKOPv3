<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\Ref\RefBank;
use Livewire\Component;

class Withdrawal_Contribution extends Component
{
    public $withdrawal;
    public $banks;

    public function showApplication($uuid)
    {
        $custApply = ApplyContribution::where('uuid', $uuid)->with('customer')->first();    
        $banks = RefBank::where('coop_id', $custApply->coop_id)->get();      

        return view('livewire.page.application.application-list.apply_withdraw_contribution', compact('custApply', 'banks'));
    }

    public function mount()    
    { 
        $this->withdrawal = ApplyContribution::where('direction', 'withdraw')->orderBy('created_at','desc')->with('customer')->get();    

        foreach ($this->withdrawal as $bank_name) {            
            $this->banks = RefBank::where('coop_id', $bank_name->coop_id)->get();   
        }
    }

    public function render()
    {
        return view('livewire.page.application.application-list.withdrawal-contribution');
    }
}
