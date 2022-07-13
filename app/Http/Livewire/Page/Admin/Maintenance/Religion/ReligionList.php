<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;

class ReligionList extends Component
{
    public $RefReligion;

    public function mount()
    {
        $this->RefReligion = RefReligion::all();
    }

    public function delete($id)
    {
        $data=RefReligion::find($id);
        $data->delete();

        session()->flash('message', 'Religion Record Deleted');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('religion.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion')->extends('layouts.head');
    }
}
