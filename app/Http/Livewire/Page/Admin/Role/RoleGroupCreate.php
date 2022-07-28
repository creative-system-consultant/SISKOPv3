<?php

namespace App\Http\Livewire\Page\Admin\Role;

use App\Models\UserRole;
use App\Models\UserRoleGroup;
use Livewire\Component;

class RoleGroupCreate extends Component
{
    public $page = 'CREATE';
    public $roles;
    public UserRoleGroup $group;

    protected $rules    = [
        'group.name'            => 'required|min:5|max:50',
        'group.description'     => 'max:255',
        'group.role_id'         => 'required',
        'group.status'          => '',
    ];
    protected $messages = [
        'group.name.*'          => 'Please specify NAME (Min 5 character, Max 255 Character)',
        'group.role_id.*'       => 'Please select a ROLE',
    ];

    public function mount($uuid = NULL){
        if ($uuid != NULL){
            $this->page  = 'EDIT';
            $this->group = UserRoleGroup::where('uuid', $uuid)->firstOrFail();
        } else {
            $this->group = new UserRoleGroup;
        }
        $this->roles = UserRole::all();
    }

    public function submit(){
        $this->validate();

        $this->group->save();

        session()->flash('message', 'Success');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('user.rolegroup');
    }

    public function render()
    {
        return view('livewire.page.admin.role.role-group-create')->extends('layouts.head');
    }
}
