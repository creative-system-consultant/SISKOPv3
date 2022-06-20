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
    public $phone_no = '';

    /** @var string */
    public $password = '';    

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name'      => ['required'],
            'icno'      => ['required', 'unique:App\Models\User'],
            'phone_no'  => ['required', 'unique:App\Models\User'],
            'email'     => ['required', 'email', 'unique:App\Models\User'],
            'password'  => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        //dd($this->phone_no);

        $user = User::create([
            'email'     => $this->email,
            'name'      => $this->name,
            'phone_no'  => $this->phone_no,
            'icno'      => $this->icno,
            'password'  => Hash::make($this->password),
        ]);

        // $user = new User;
        // $user->email     = $this->email;
        // $user->name      = $this->name;
        // $user->phone_no  = $this->phone_no;
        // $user->icno      = $this->icno;
        // $user->password  = Hash::make($this->password);

        $user->save();

        event(new Registered($user));

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
