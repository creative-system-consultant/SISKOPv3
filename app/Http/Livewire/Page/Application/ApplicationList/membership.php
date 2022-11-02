<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyMembership as ApplyMember;
use Livewire\Component;

class membership extends Component
{
    public $membership, $custApply;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyMember::where('uuid', $uuid)->with('customer')->first();
    }


    public function mount()
    {
        $user = auth()->user();
        $this->membership        = ApplyMember::where('coop_id',  $user->coop_id)->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.membership');
    }
}
