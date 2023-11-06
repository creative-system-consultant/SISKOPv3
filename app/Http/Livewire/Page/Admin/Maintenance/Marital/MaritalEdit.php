<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;
use App\Models\User;

class MaritalEdit extends Component
{
    public User $User;
    public RefMarital $marital;

    protected $rules = [
        'marital.description' => ['required', 'string'],
        'marital.code'        => ['required', 'string'],
        'marital.status'      => ['required'],
    ];

    public function submit()
    {
        $this->marital->description = trim(strtoupper($this->marital->description));
        $this->marital->code        = trim(strtoupper($this->marital->code));
        $this->marital->status      = $this->marital->status == true ? '1' : '0';
        $this->marital->updated_by  = $this->User->name;
        $this->marital->save();

        session()->flash('message', 'Marital Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('marital.list');
    }

    public function mount($id)
    {
        $this->User    = User::find(auth()->user()->id);
        $this->marital = RefMarital::where('id', $id)->first();
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.marital.edit')->extends('layouts.head');
    }
}