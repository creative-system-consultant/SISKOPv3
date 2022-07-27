<?php

namespace App\Http\Livewire\Page\Admin\Membership;

use App\Models\FieldMaster;
use App\Models\Membership;
use App\Models\MembershipField;
use Livewire\Component;

class MembershipAdmin extends Component
{

    public Membership $membership;
    public $field = [];

    protected $rules    = [];
    protected $messages = [];
    protected $validationAttributes = [];

    public function mount(){
        $this->membership = Membership::firstOrCreate([
            'coop_id'       => auth()->user()->coop_id,
        ],[
            'created_by'    => auth()->user()->name,
        ]);
    }

    public function enableFn($id)
    {
        $field = MembershipField::firstOrCreate([
            'membership_id' => $this->membership->id,
            'coop_id'       => auth()->user()->coop_id,
            'field_id'      => $id,
        ]);

        $field->update([
            'status'    => !$field->status,
        ]);
    }

    public function submit(){
        
    }

    public function render()
    {
        return view('livewire.page.admin.membership.membership-admin')->extends('layouts.head');
    }
}
