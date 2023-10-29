<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Country;

use App\Models\Ref\RefCountry;
use App\Models\User;
use Livewire\Component;

class CountryCreate extends Component
{
    public User $User;
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
            'client_id'         => $this->User->client_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Country Information Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('country.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.countries.countrycreate')->extends('layouts.head');
    }
}