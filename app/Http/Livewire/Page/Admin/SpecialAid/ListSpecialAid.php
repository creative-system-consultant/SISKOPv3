<?php

namespace App\Http\Livewire\Page\Admin\SpecialAid;

use App\Models\SpecialAid;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ListSpecialAid extends Component
{
    public $specialAids;
    public $statusTabung;

    public function statusUpdate($uuid, $index)
    {
        // dd($this->statusTabung[$index]);
        $specialAid = SpecialAid::where('uuid', $uuid)->first();
        
        $specialAid->update([
            'status' => $this->statusTabung[$index] == true ? 1 : 0,
        ]);
    }

    public function mount()
    {
        $user = Auth()->user();

        $this->specialAids = SpecialAid::where('coop_id', $user->coop_id)->get();

        foreach ($this->specialAids as $index => $value) {
            $this->statusTabung[$index] = $value->status == 1 ? 'checked' : false;
        }
    }


    public function render()
    {
        return view('livewire.page.admin..special-aid.list-special-aid')->extends('layouts.head');
    }
}
