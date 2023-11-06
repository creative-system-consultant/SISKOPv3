<?php

namespace App\Http\Livewire\Page\Executive\Approval\SpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAidChecker extends Component
{
    public $checker;
    public $types;

    public function next()
    {
        return redirect()->route('specialAid.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
        $this->checker = ApplySpecialAid::where('uuid', $uuid)->with('customer')->first();

        $this->type = SpecialAidType::where('id', $this->checker->special_aid_id)->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.special-aid.special-aid-checker')->extends('layouts.head');
    }
}
