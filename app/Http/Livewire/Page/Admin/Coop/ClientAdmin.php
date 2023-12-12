<?php

namespace App\Http\Livewire\Page\Admin\Coop;

use App\Models\Client;
use Livewire\Component;

class ClientAdmin extends Component
{
    public $coops;

    public function mount()
    {
        $this->coops = Client::withTrashed()->get();
    }

    public function delete($id)
    {
        $data=Client::find($id);
        $data->delete();

        session()->flash('message', 'COOP Delete Success');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('Coop.Index');
    }

    public function render()
    {
        return view('livewire.page.admin.coop.index')->extends('layouts.head');
    }
}

