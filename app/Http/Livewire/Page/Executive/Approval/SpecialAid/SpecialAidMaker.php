<?php

namespace App\Http\Livewire\Page\Executive\Approval\SpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\Approval;
use App\Models\SpecialAid as SpecialAidType;
use App\Models\User;
use Livewire\Component;

class SpecialAidMaker extends Component
{
    public $maker;
    public $type;
    public ApplySpecialAid $Apply;
    public Approval $Approval;
    public User $User;


    public function next()
    {
        $this->Apply->step++;
        $this->Apply->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        return redirect()->route('specialAid.checker', $this->maker->uuid);
    }

    public function mount($uuid)
    {
        $this->User      = User::find(auth()->user()->id);

        $this->Apply = ApplySpecialAid::where('uuid', $uuid)->with('customer')->first();

        // $this->type = SpecialAidType::where('id', $this->maker->special_aid_id)->first();

        $this->Approval  = Approval::where([
            ['approval_id', $this->Apply->id],
            ['approval_type', 'App\Models\ApplySpecialAid'],
            ['order', $this->Apply->step]
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.special-aid.special-aid-maker')->extends('layouts.head');
    }
}
