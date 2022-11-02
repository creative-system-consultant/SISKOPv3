<?php

namespace App\Http\Livewire\Page\Executive\Approval\SpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAidCommittee extends Component
{
    public $committee;
    public $types;

    public function next()
    {
        return redirect()->route('specialAid.approval', $this->committee->uuid);
    }

    public function mount($uuid)
    {
        $this->committee = ApplySpecialAid::where('uuid', $uuid)->with('customer')->first();

        $this->type = SpecialAidType::where('id', $this->committee->special_aid_id)->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.special-aid.special-aid-committee')->extends('layouts.head');
    }
}
