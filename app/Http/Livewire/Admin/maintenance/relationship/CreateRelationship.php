<?php

namespace App\Http\Livewire\Admin\maintenance\relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;

class CreateRelationship extends Component
{
    public $relationship_description;
    public $relationship_code;
    public $relationship_status;
    public $relationship;

    public function submit()
    {
        $this->validate([
            'relationship_description' => ['required', 'string'],
            'relationship_code'        => ['required', 'string'],
        ]);

        $relationship = RefRelationship::create([
            'description' => $this->relationship_description,
            'code'        => $this->relationship_code,
            'status'      => $this->relationship_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Relationship Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('relationship.list');
    }

    public function render()
    {
        return view ('maintenance.relationship.create')->extends('layouts.head');
    }
}