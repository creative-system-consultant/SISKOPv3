<?php

namespace App\Http\Livewire\Page\Executive\Approval\SpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAidMaker extends Component
{
    public $maker;
    public $type;

    public function next()
    {
        return redirect()->route('specialAid.checker', $this->maker->uuid);
    }

    public function mount($uuid)    
    { 
        $this->maker = ApplySpecialAid::where('uuid', $uuid)->with('customer')->first();
              
        $this->type = SpecialAidType::where('id', $this->maker->special_aid_id)->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.special-aid.special-aid-maker')->extends('layouts.head');
    }
}
