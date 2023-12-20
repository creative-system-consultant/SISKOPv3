<?php

namespace App\Http\Livewire\Page\Admin\Role;

use App\Models\ClientRoleGroup;
use App\Models\User;
use Livewire\Component;

class RoleGroupManagement extends Component
{
    public User $User;
    public $rolegroup;

    protected $rules    = [];
    protected $messages = [];
    protected $validationAttributes = [];

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->rolegroup = ClientRoleGroup::where('client_id', $this->User->client_id)->get();
    }

    public function submit()
    {
        //
    }

    public function render()
    {
        return view('livewire.page.admin.role.role-group-management')->extends('layouts.head');
    }
}
