<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAid extends Component
{    
    public $specialAid;
    public $specialAid_type;
    public $custApply;

    public function showApplication($uuid)
    {
        $custApply = ApplySpecialAid::where('uuid', $uuid)->first();        
        $type = SpecialAidType::where('id', $custApply->special_aid_id)->first();

        return view('livewire.page.application.application-list.apply_specialAid', compact('custApply', 'type'));
    }

    public function mount()    
    { 
        $this->specialAid = ApplySpecialAid::orderBy('created_at','desc')->with('customer')->get();
        
        foreach ($this->specialAid as $type) {            
            $this->specialAid_type = SpecialAidType::where('id', $type->special_aid_id)->get();
        }
    }

    public function render()
    {
        return view('livewire.page.application.application-list.special-aid');
    }
}
