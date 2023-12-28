<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\CloseMembership as CloseMemberships;
use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class CloseMembership extends Component
{
    public User $User;
    public CloseMemberships $closemembership;
    public $closememberships;
    public $custApply,$type;

    public function showApplication($uuid)
    {
        $this->closemembership = CloseMemberships::where('uuid', $uuid)->first();
        $this->custApply = Customer::where('id', $this->closemembership->cust_id)->first();
    }

    public function remake_approvals()
    {
        $this->closemembership->remove_approvals();
        $this->closemembership->make_approvals();
        $this->closemembership->step = 1;
        $this->closemembership->save();

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
        $this->User = User::find(auth()->user()->id);
        $this->closememberships = CloseMemberships::where('client_id', auth()->user()->client_id)->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.close-membership');
    }
}