<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Bank;

use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class BankCreate extends Component
{
    public User $User;
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
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'client_id'         => $this->User->client_id,
            'created_at'      => now(),
            'created_by'      => $this->User->name,
        ]);

        session()->flash('message', 'Bank Information Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('bank.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bankcreate')->extends('layouts.head');
    }
}