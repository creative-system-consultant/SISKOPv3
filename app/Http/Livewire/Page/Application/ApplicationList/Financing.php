<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\User;
use App\Models\AccountMaster as ApplyFinancing;
use App\Models\Ref\RefGender;
use Livewire\Component;

class Financing extends Component
{
    public User $User;
    public $financing;
    public $custApply;
    public $gender;
    public $genderName;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyFinancing::where('uuid', $uuid)->with('customer')->first();
        $this->genderName = RefGender::where('coop_id', $this->custApply->coop_id)->get();
    }

    public function mount()
    {
        $this->User = Auth()->user();

        $this->financing = ApplyFinancing::where('coop_id', $this->User->coop_id)->orderBy('created_at','desc')->with('customer')->get();

        foreach ($this->financing as $gender_name) {
            $this->gender = RefGender::where('coop_id', $gender_name->coop_id)->get();
        }
    }

    public function render()
    {
        return view('livewire.page.application.application-list.financing');
    }
}