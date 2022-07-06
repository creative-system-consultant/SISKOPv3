<?php

namespace App\Http\Livewire\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;

class religionedit extends Component
{

        public $description;
        public $code;
        public $status;
        public $RefReligion;
    
        public function submit($id)
        {
        $this->validate([
            'description'    => ['required', 'string'],
            'code'           => ['required', 'string'],
        ]);

        $RefReligion = RefReligion::where('id', $id)->first();
        
        $RefReligion->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Religion Details Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('religion.list');
    }

    public function  loadUser($id)
    {
        $RefReligion = RefReligion::where('id', $id)->first();          

        $this->description  = $RefReligion->description;
        $this->code         = $RefReligion->code;
        $this->status       = $RefReligion->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->RefReligion = RefReligion::where('id', $id)->first();

        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religionedit')->extends('layouts.head');
    }

}