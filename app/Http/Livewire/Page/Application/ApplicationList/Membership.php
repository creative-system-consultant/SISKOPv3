<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyMembership as ApplyMember;
use App\Models\SiskopCustomer;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Membership extends Component
{
    use WithPagination;

    public User $User;
    public SiskopCustomer $Cust;
    public $membership;

    public function clearApplication()
    {
        $this->membership = NULL;
    }

    public function showApplication($uuid)
    {
        $this->membership = ApplyMember::where('uuid', $uuid)->with('customer')->first();
        $this->Cust = $this->membership->customer;
    }

    public function remake_approvals()
    {
        $this->membership->remove_approvals();
        $this->membership->make_approvals();
        $this->membership->step = 1;
        $this->membership->save();

        $this->dispatchBrowserEvent('swal',[
            'title' => 'Success!',
            'text'  => 'Approvals have been reset',
            'icon'  => 'success',
            'showConfirmButton' => false,
            'timer' => 360000,
        ]);
    }

    public function mount()
    {
        $this->User = auth()->user();
    }

    public function render()
    {
        $memberships = ApplyMember::where('client_id', $this->User->client_id)->orderBy('created_at','desc')->with('customer')->paginate(5);

        //dd($this->membership[0]->current_approval());
        return view('livewire.page.application.application-list.membership',[
            'memberships' => $memberships,
        ]);
    }
}
