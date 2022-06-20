<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';
    
    /** @var string */
    public $icno = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';    
    

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name'      => ['required'],
            'icno'      => ['required'],
            'email'     => ['required', 'email', 'unique:App\Models\User'],
            'password'  => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        // dd($this->icno);

        $user = User::create([
            'email'     => $this->email,
            'name'      => $this->name,
            'icno'      => $this->icno,
            'password'  => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
