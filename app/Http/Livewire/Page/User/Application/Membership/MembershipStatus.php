<?php

namespace App\Http\Livewire\Page\User\Application\Membership;

use App\Models\ApplyMembership;
use App\Models\Coop;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class MembershipStatus extends Component
{
    public User $User;
    public Coop $Coop;
    public $coops;
    public $memberships;

    public function mount()
    {
        $this->User     = User::find(auth()->user()->id);
        $Customer       = Customer::where('coop_id', $this->User->coop_id)->first();
        $this->Coop     = Coop::find($this->User->coop_id);
        $this->coops    = Coop::where([['id',$this->User->all_coop_id]])->get();
        $this->memberships = ApplyMembership::where([['cust_id', $Customer->id]])->with('coop')->get();
    }

    public function deb()
    {
        dd([
            'Coops' => $this->coops,
            'Coop'  => $this->Coop,
            'membership' => $this->memberships,
            'member_coop' => $this->memberships[0]->coop,
            'member_cust' => $this->memberships[0]->customer,
        ]);
    }

    public function render()
    {
        return view('livewire.page.user.application.membership.membership-status')->extends('layouts.head');
    }
}
