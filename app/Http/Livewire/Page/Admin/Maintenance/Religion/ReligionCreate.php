<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Religion;

use App\Models\Ref\RefReligion;
use App\Models\User;
use Livewire\Component;

class ReligionCreate extends Component
{
    public User $User;
    public $description;
    public $code;
    public $status;
    public $RefReligion;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $RefBank = RefReligion::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'client_id'         => $this->User->client_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Religion Information Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('religion.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religioncreate')->extends('layouts.head');
    }
}