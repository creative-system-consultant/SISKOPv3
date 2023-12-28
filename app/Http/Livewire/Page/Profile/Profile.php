<?php

namespace App\Http\Livewire\Page\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    public User $User;

    protected $rules = [
        'User.name'     => ['required', 'string'],
        'User.icno'     => ['required', 'string'],
        'User.phone_no' => ['required', 'string'],
        'User.email'    => ['required', 'string'],
    ];

    public function submit()
    {
        $this->validate();
        $this->User->save();

        session()->flash('message', 'Profile Details Updated');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('Index');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.page.profile.profile')->extends('layouts.head');
    }
}
