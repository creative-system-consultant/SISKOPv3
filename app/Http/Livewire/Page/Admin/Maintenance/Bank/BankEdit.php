<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Bank;

use Livewire\Component;
use App\Models\Ref\RefBank;

class BankEdit extends Component
{

        public $description;
        public $code;
        public $status;
        public $RefBank;
    
        public function submit($id)
        {
        $this->validate([
            'description'    => ['required', 'string'],
            'code'           => ['required', 'string'],
        ]);

        $RefBank = RefBank::where('id', $id)->first();
        
        $RefBank->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);

        session()->flash('message', 'Bank Details Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('bank.list');
    }

    public function  loadUser($id)
    {
        $RefBank = RefBank::where('id', $id)->first();          

        $this->description  = $RefBank->description;
        $this->code         = $RefBank->code;
        $this->status       = $RefBank->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->RefBank = RefBank::where('id', $id)->first();

        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bankedit')->extends('layouts.head');
    }

}
