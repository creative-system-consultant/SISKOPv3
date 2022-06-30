<?php

namespace App\Http\Livewire\Page\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Auth;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    // public $Uid;
    public $name;
    public $icno;
    public $phone_no;
    public $email; 
    public $User; 

    public function submit($id)
{
    $this->validate([
        'name'           => ['required', 'string'],
        'icno'           => ['required', 'string'],
        'phone_no'       => ['required', 'string'],
        'email'          => ['required', 'string'],
    ]);

    $User = User::where('id', $id)->first();
    
    $User->update([
        'name'                => $this->name,
        'icno'                => $this->icno,
        'phone_no'            => $this->phone_no,
        'email'               => $this->email,
    ]);

    session()->flash('message', 'Profile Details Updated');
    session()->flash('success');
    session()->flash('title');

    return redirect()->route('Index');
}

public function  loadUser($id)
{
    $User = User::where('id', $id)->first();          

    $this->name             = $User->name;
    $this->icno             = $User->icno;
    $this->phone_no         = $User->phone_no;
    $this->email            = $User->email;
} 

public function mount()
{
    $user = auth()->user();
    $this->User = User::where('id', $user->id)->first();

    $this->name         = $this->User->name;
    $this->icno         = $this->User->icno;
    $this->phone_no     = $this->User->phone_no;
    $this->email        = $this->User->email;
    // $this->loadUser($id);
    // dd($id);
}

    public function render()
    {
        return view('livewire.page.profile.profile')->extends('layouts.head');
    }
}
