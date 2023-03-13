<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;
use App\Models\User;

class RelationshipCreate extends Component
{
    public User $User;
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
            'description' => trim(strtoupper($this->relationship_description)),
            'code'        => trim(strtoupper($this->relationship_code)),
            'coop_id'     => $this->User->coop_id,
            'status'      => $this->relationship_status == true ? '1' : '0',
            'created_at'  => now(),
            'created_by'  => Auth()->user()->name,
        ]);

        session()->flash('message', 'Relationship Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('relationship.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.relationship.create')->extends('layouts.head');
    }
}
