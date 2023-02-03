<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyMembership as ApplyMember;
use App\Models\User;
use Livewire\Component;

class Membership extends Component
{
    public User $User;
    public $memberships;
    public $custApply;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyMember::where('uuid', $uuid)->with('customer')->first();
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->memberships = ApplyMember::where('coop_id', $this->User->coop_id)->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        //dd($this->membership[0]->current_approval());
        return view('livewire.page.application.application-list.membership');
    }
}
