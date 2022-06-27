<?php

namespace App\Http\Livewire\Admin\maintenance\relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;

class ListRelationship extends Component
{

    public $relationship;

    public function mount()
    {
        $this->relationship = RefRelationship::get();
    }

    public function delete($id)
    {
        $data = RefRelationship::find($id);
        $data->delete();

        session()->flash('message', 'Relationship Deleted');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('relationship.list');
    }

    public function render()
    {
        return view ('maintenance.relationship.index')->extends('layouts.head');
    }

}