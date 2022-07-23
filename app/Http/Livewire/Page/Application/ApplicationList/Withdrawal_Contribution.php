<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\Ref\RefBank;
use Livewire\Component;

class Withdrawal_Contribution extends Component
{
    public $withdrawal;
    public $custApply, $bankName;
    public $banks;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyContribution::where('uuid', $uuid)->with('customer')->first();    
        $this->bankName = RefBank::where('coop_id', $this->custApply->coop_id)->get();      
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
