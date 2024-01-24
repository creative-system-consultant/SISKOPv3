<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplySpecialAid;
use App\Models\SpecialAid as SpecialAidType;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialAid extends Component
{
    use WithPagination;
    public $User;
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
    }

    public function render()
    {
        $specialAid = ApplySpecialAid::orderBy('created_at', 'desc')->with('customer')->with('specialAidType')->paginate(5);
        return view('livewire.page.application.application-list.special-aid',[
            'specialAid' => $specialAid,
        ]);
    }
}
