<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class SpecialAid extends Component
{
    public $specialAid, $User;
    public $specialAid_type;
    public $custApply, $type;

    public function showApplication($uuid)
    {
        $this->custApply = ApplySpecialAid::where('uuid', $uuid)->first();
        $this->type = SpecialAidType::where('id', $this->custApply->special_aid_id)->first();
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->specialAid = ApplySpecialAid::orderBy('created_at', 'desc')->with('customer')->with('specialAidType')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.special-aid');
    }
}
