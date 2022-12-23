<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;

class special_aid extends Component
{
    public $specialAid;
    public $specialAid_type;
    public $custApply,$type;

    public function showApplication($uuid)
    {
        $this->custApply = ApplySpecialAid::where('uuid', $uuid)->first();
        $this->type = SpecialAidType::where('id', $this->custApply->special_aid_id)->first();
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
        return view('livewire.page.application.application-list.special_aid');
    }
}
