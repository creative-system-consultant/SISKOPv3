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
    public $client_id;
    public $specialAid_type;
    public $custApply, $type;
    public $route;

    public function showApplication($uuid)
    {
        $this->custApply = ApplySpecialAid::where('uuid', $uuid)->first();
        $this->type = SpecialAidType::where('id', $this->custApply->special_aid_id)->first();
    }

    public function mount($route)
    {
        $this->route = $route;
        $this->User = auth()->user();
        $this->client_id = $this->User->client_id;
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $specialAid = ApplySpecialAid::where('client_id', $this->client_id)
                                            ->where('flag', 1)
                                            ->orderBy('created_at', 'desc')
                                            ->with('customer')
                                            ->with('specialAidType')
                                            ->paginate(5);
        } else {
            $specialAid = ApplySpecialAid::where('client_id', $this->client_id)
                                            ->where('flag', '!=', 0)
                                            ->orderBy('created_at', 'desc')
                                            ->with('customer')
                                            ->with('specialAidType')
                                            ->paginate(5);
        }

        return view('livewire.page.application.application-list.special-aid',[
            'specialAid' => $specialAid,
        ]);
    }
}
