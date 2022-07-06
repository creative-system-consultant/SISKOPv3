<?php

namespace App\Http\Livewire\Admin\maintenance\marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;

class EditMarital extends Component
{
    public $marital_description;
    public $marital_code;
    public $marital_status;
    public $marital;

    public function submit($id)
    {
        $this->validate([
            'marital_description' => ['required', 'string'],
            'marital_code'        => ['required', 'string'],
        ]);

        $marital = RefMarital::where('id', $id)->first(); 

        $marital->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Marital Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('marital.list'); 
    }

    public function load($id)
    {
        $marital = RefMarital::where('id', $id)->first();          

        $this->marital_description    = $marital->description; 
        $this->marital_code           = $marital->code;
        $this->marital_status         = $marital->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->marital = RefMarital::where('id', $id)->first();

        $this->load($id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.marital.edit')->extends('layouts.head');
    }
}