<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Bank;

use Livewire\Component;
use App\Models\Ref\RefBank;

class BankList extends Component
{
    public $RefBank;

    public function mount()
    {
        $this->RefBank = RefBank::where('client_id', Auth()->User()->client_id)->get();
    }

    public function delete($id)
    {
        $data=RefBank::find($id);
        $data->delete();

        session()->flash('message', 'Bank Record Deleted');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('bank.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bank')->extends('layouts.head');
    }
}

