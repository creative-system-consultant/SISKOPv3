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
        'group.name'            => 'required|min:3|max:50',
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
            $this->group->created_by = $this->user->name;
        }
        $this->roles = UserRole::all();
    }

    public function searchUser()
    {
        if(strlen($this->search) > 2 ){
            $this->searchResult = User::where('name', 'like', '%'.$this->search.'%')->select('id','name')->orderBy('name')->take(5)->get();
            if($this->searchResult->count() == 1 ){
                $this->selected = $this->searchResult->first()->id;
            } else {
                $this->selected = '';
            }
        } else {
            $this->searchResult = [];
            $this->selected = '';
        }
    }

    public function add()
    {
        $this->ids   = [...$this->ids, $this->selected ];
        $this->users = User::whereIn('id', $this->ids)->get();
        $this->idrem = array_diff($this->idrem, [$this->selected]);
    }

    public function deb()
    {
        dump([
            'id'    => $this->ids,
            'user'  => $this->users,
            'selected' => $this->selected,
            'idrem' => $this->idrem,
            'users' => $this->group->users,
            'errorbag' => $this->getErrorBag(),
            'count' => $this->users->count(),
            'rolename' => $this->group->role->name,
        ]);
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
        $this->group->updated_by = $this->user->name;
        $this->validate();
        $this->ids = array_filter($this->ids);

        if($this->ids == []){
            if ($this->group->status == 1){
                $this->addError('group.status', 'Can\'t set active without any members');
                return back();
            }
        }

        if( $this->group->role->name == 'COMMITTEE'){
            if($this->group->status == 1 && ($this->users->count() < 3 || $this->users->count() % 2 == 0)){
                $this->addError('group.status', 'Can\'t set active. Committee must have at least 3 members and must be in odd numbers (3,5,7 ...)');
                return back();
            }
        }

        if( $this->group->role->name == 'APPROVER'){
            if($this->group->status == 1 && $this->users->count() % 2 == 0){
                $this->addError('group.status', 'Can\'t set active. Approver must have at least 1 member and must be in odd numbers (1,3,5,7 ...)');
                return back();
            }
        }

        $this->group->save();
        foreach ($this->ids as $key => $value) {
            $this->group->users()->updateOrCreate([
                'user_id'   => $value,
                'updated_by'=> $this->user->name,
            ]);
        }

        $this->group->users()->whereIn('user_id', $this->idrem)->delete(); //forceDelete()

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
