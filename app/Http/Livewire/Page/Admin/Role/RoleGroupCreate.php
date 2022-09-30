<?php

namespace App\Http\Livewire\Page\Admin\Role;

use App\Models\User;
use App\Models\UserRole;
use App\Models\CoopRoleGroup;
use Livewire\Component;

class RoleGroupCreate extends Component
{
    public $page = 'CREATE';
    public $roles;
    public $user;
    public $users = [];
    public $ids   = [];
    public $idrem = [];
    public $search;
    public $searchResult = [];
    public $selected;
    public CoopRoleGroup $group;

    protected $rules    = [
        'group.name'            => 'required|min:5|max:50',
        'group.description'     => 'max:255',
        'group.role_id'         => 'required',
        'group.status'          => '',
        'group.coop_id'         => 'required',
    ];
    protected $messages = [
        'group.name.*'          => 'Please specify NAME (Min 5 character, Max 255 Character)',
        'group.role_id.*'       => 'Please select a ROLE',
    ];

    public function mount($uuid = NULL){
        $this->user = Auth()->user();
        if ($uuid != NULL){
            $this->page  = 'EDIT';
            $this->group = CoopRoleGroup::where('uuid', $uuid)->firstOrFail();
            $this->ids   = $this->group->getids();
            $this->users = User::whereIn('id', $this->ids)->get();
        } else {
            $this->group          = new CoopRoleGroup;
            $this->group->coop_id = $this->user->coop_id;
        }
        $this->roles = UserRole::all();
    }

    public function searchUser()
    {
        if(strlen($this->search) > 2 ){
            $this->searchResult = User::where('name', 'like', '%'.$this->search.'%')->select('id','name')->orderBy('name')->take(5)->get();
            $this->selected = '';
        }
    }

    public function add()
    {
        $this->ids   = [...$this->ids, $this->selected ];
        $this->users = User::whereIn('id', $this->ids)->get();
    }

    public function deb()
    {
        dump($this->ids, $this->users);
        dump($this->idrem);
        dump($this->group->users);
    }

    public function rem($id)
    {
        $this->idrem = [...$this->idrem, $id ];
        $this->ids = array_diff($this->ids, [$id]);
        $this->users = User::whereIn('id', $this->ids)->get();
    }

    public function submit()
    {
        $this->group->name = strtoupper($this->group->name);
        $this->validate();

        $this->group->save();
        foreach ($this->ids as $key => $value) {
            $this->group->users()->updateOrCreate([
                'user_id'   => $value,
            ]);
        }

        $this->group->users()->whereIn('user_id', $this->idrem)->delete();

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
