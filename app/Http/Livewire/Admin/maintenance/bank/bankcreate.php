<?php

namespace App\Http\Livewire\Admin\Maintenance\Bank;

use App\Models\Ref\RefBank;
use Livewire\Component;

class bankcreate extends Component
{
    public $description;
    public $code;
    public $status;
    public $RefBank;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $RefBank = RefBank::create([
            'description'       => $this->description,
            'code'              => $this->code,
            'status'            => $this->status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Bank Information Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('bank');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bankcreate')->extends('layouts.head');
    }
}