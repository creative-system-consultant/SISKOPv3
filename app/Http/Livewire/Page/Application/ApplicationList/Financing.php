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
