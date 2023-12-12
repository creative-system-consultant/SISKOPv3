<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;

class RelationshipList extends Component
{

    public $relationship;

    public function mount()
    {
        $this->relationship = RefRelationship::where('client_id', auth()->user()->client_id)->get();
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
        return view ('livewire.admin.maintenance.relationship.index')->extends('layouts.head');
    }

}