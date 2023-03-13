<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Gender;

use App\Models\Ref\RefGender;
use App\Models\User;
use Livewire\Component;

class GenderCreate extends Component
{
    public User $User;
    public $description;
    public $code;
    public $status;
    public $RefGender;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $RefGender = RefGender::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'coop_id'         => $this->User->coop_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Gender Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('gender.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gendercreate')->extends('layouts.head');
    }
}