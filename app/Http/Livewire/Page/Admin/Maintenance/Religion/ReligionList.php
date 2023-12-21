<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;
use App\Models\User;

class ReligionList extends Component
{
    public User $User;
    public $RefReligion;

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->RefReligion = RefReligion::where('client_id', $this->User->client_id)->get();
    }

    public function delete($id)
    {
        $data=RefReligion::find($id);
        $data->delete();

        session()->flash('message', 'Religion Record Deleted');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('religion.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion')->extends('layouts.head');
    }
}
