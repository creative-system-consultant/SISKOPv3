<?php

namespace App\Http\Livewire\Page\Admin\coop;

use App\Models\Coop;
use Livewire\Component;

class CoopAdmin extends Component
{
    public $coops;

    public function mount()
    {
        $this->coops = Coop::withTrashed()->get();
    }

    public function delete($id)
    {
        $data=Coop::find($id);
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

