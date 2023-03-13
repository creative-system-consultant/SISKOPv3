<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\User;
use App\Models\AccountMaster;
use App\Models\Ref\RefGender;
use Livewire\Component;

class Financing extends Component
{
    public User $User;
    public AccountMaster $financing;
    public $financings;
    public $gender;
    public $genderName;

    public function closeApplication()
    {
        $this->financing = new AccountMaster;
    }

    public function showApplication($uuid)
    {
        $this->financing = AccountMaster::where('uuid', $uuid)->with('customer')->first();
        $this->genderName = RefGender::where('coop_id', $this->financing->coop_id)->get();
    }

    public function remake_approvals()
    {
        $this->financing->remove_approvals();
        $this->financing->make_approvals();
        $this->financing->apply_step = 1;
        $this->financing->save();

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
        $this->User = Auth()->user();

        $this->financings = AccountMaster::where('coop_id', $this->User->coop_id)->orderBy('created_at','desc')->with('customer')->get();

        $this->gender = RefGender::where('coop_id', $this->User->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.financing');
    }
}
