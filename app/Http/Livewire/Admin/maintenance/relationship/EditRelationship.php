<?php

namespace App\Http\Livewire\Admin\maintenance\relationship;

use App\Models\Ref\RefRelationship;
use Livewire\Component;

class EditRelationship extends Component
{
    public $relationship_description;
    public $relationship_code;
    public $relationship_status;
    public $relationship;

    public function submit($id)
    {
        $this->validate([
            'relationship_description' => ['required', 'string'],
            'relationship_code'        => ['required', 'string'],
        ]);

        $race = RefRelationship::where('id', $id)->first(); 

        $race->update([
            'description' => $this->relationship_description,
            'code'        => $this->relationship_code,
            'status'      => $this->relationship_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Relationship Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('relationship.list'); 
    }

    public function load($id)
    {
        $relationship = RefRelationship::where('id', $id)->first();          

        $this->relationship_description    = $relationship->description; 
        $this->relationship_code           = $relationship->code;
        $this->relationship_status         = $relationship->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->relationship = RefRelationship::where('id', $id)->first();

        $this->load($id);
    }

    public function render()
    {
        return view ('maintenance.relationship.edit')->extends('layouts.head');
    }
}