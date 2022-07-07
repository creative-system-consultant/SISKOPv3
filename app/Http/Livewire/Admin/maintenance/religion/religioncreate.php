<?php

namespace App\Http\Livewire\Admin\Maintenance\religion;

use App\Models\Ref\RefReligion;
use Livewire\Component;

class religioncreate extends Component
{
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
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Religion Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('religion.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religioncreate')->extends('layouts.head');
    }
}