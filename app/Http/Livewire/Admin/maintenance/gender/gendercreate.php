<?php

namespace App\Http\Livewire\Admin\Maintenance\gender;

use App\Models\Ref\RefGender;
use Livewire\Component;

class gendercreate extends Component
{
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
            'description'       => $this->description,
            'code'              => $this->code,
            'status'            => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Gender Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('gender');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gendercreate')->extends('layouts.head');
    }
}