<?php

namespace App\Http\Livewire\Page\Admin\SpecialAid;

use App\Models\SpecialAid;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ListSpecialAid extends Component
{
    public $specialAids;
    public $status_tabung;

    public function loadStatus($coop_id)
    {
        $specialAid = SpecialAid::where('coop_id', $coop_id)->first();
        $this->isActive = $specialAid->status == 1 ? 'checked' : false;
    }

    public function mount()
    {
        $user = Auth()->user();
        $this->specialAids = SpecialAid::where('coop_id', $user->coop_id)->get();
        
        $this->loadStatus($user->coop_id);
    }

    public function updateStatus($uuid)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        // dd($this->status_tabung);

        $specialAid->update([
            'status' => $this->status_tabung == true ? 1 : 0,
        ]);
    }

    public function render()
    {
        return view('livewire.page.admin..special-aid.list-special-aid')->extends('layouts.head');
    }
}
