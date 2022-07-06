<?php

namespace App\Http\Livewire\Admin\Maintenance\countries;

use App\Models\Ref\RefCountry;
use Livewire\Component;

class countrycreate extends Component
{
    public $description;
    public $code;
    public $status;
    public $RefCountry;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $RefCountry = RefCountry::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Country Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('country.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.countries.countrycreate')->extends('layouts.head');
    }
}