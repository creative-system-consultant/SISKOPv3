<?php

namespace App\Http\Livewire\Admin\Maintenance\state;

use Livewire\Component;
use App\Models\Ref\RefState;

class stateedit extends Component
{

        public $description;
        public $code;
        public $status;
        public $RefState;
    
        public function submit($id)
        {
        $this->validate([
            'description'    => ['required', 'string'],
            'code'           => ['required', 'string'],
        ]);

        $RefState = RefState::where('id', $id)->first();
        
        $RefState->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'State Details Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('state.list');
    }

    public function  loadUser($id)
    {
        $RefState = RefState::where('id', $id)->first();          

        $this->description  = $RefState->description;
        $this->code         = $RefState->code;
        $this->status       = $RefState->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->RefState = RefState::where('id', $id)->first();

        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.stateedit')->extends('layouts.head');
    }

}
