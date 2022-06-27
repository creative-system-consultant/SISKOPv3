<?php

namespace App\Http\Livewire\Admin\Maintenance\countries;

use Livewire\Component;
use App\Models\Ref\RefCountry;

class countryedit extends Component
{

        public $description;
        public $code;
        public $status;
        public $RefCountry;
    
        public function submit($id)
        {
        $this->validate([
            'description'    => ['required', 'string'],
            'code'           => ['required', 'string'],
        ]);

        $RefCountry = RefCountry::where('id', $id)->first();
        
        $RefCountry->update([
            'description'     => $this->description,
            'code'            => $this->code,
            'status'          => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Country Details Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('country');
    }

    public function  loadUser($id)
    {
        $RefCountry = RefCountry::where('id', $id)->first();          

        $this->description  = $RefCountry->description;
        $this->code         = $RefCountry->code;
        $this->status       = $RefCountry->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->RefCountry = RefCountry::where('id', $id)->first();

        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.countries.countryedit')->extends('layouts.head');
    }

}