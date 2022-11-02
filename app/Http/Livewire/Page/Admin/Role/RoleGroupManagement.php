<?php

namespace App\Http\Livewire\Page\Admin\Role;

use App\Models\CoopRoleGroup;
use Livewire\Component;

class RoleGroupManagement extends Component
{
    public $rolegroup;

    protected $rules    = [];
    protected $messages = [];
    protected $validationAttributes = [];

    public function mount(){
        $this->rolegroup = CoopRoleGroup::all();
    }

    public function submit(){

    }

    public function render()
    {
        return view('livewire.page.admin.role.role-group-management')->extends('layouts.head');
    }
}
