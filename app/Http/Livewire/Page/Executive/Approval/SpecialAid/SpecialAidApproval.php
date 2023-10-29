<?php

namespace App\Http\Livewire\Page\Executive\Approval\SpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAidApproval extends Component
{
    public $approve;
    public $types;

    public function submit()
    {
        session()->flash('message', 'Special Aid application has been successfully approved');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('application.list');
    }

    public function next()
    {
        return redirect()->route('specialAid.committee', $this->checker->uuid);
    }

    public function mount($uuid)
    {
        $this->approve = ApplySpecialAid::where('uuid', $uuid)->with('customer')->first();

        $this->type = SpecialAidType::where('id', $this->approve->special_aid_id)->first();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.special-aid.special-aid-approval')->extends('layouts.head');
    }
}
