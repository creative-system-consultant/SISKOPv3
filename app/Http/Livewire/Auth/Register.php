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
        //Check if ic exists
        $user = User::where('icno',$this->icno)->first();

        if(!$user){
            $this->validate([
                'name'      => ['required'],
                'icno'      => ['required'],
                'phone_no'  => ['required'],
                'email'     => ['required', 'email', 'unique:App\Models\User'],
                'password'  => ['required', 'min:8', 'same:passwordConfirmation'],
            ]);

            $user = User::create([
                'email'     => $this->email,
                'name'      => $this->name,
                'phone_no'  => $this->phone_no,
                'icno'      => $this->icno,
                'password'  => Hash::make($this->password),
                'user_type' => 4
            ]);

            $user->save();

            event(new Registered($user));

            Auth::login($user, true);

            return redirect()->intended(route('home'));
        }else{
            $this->dispatchBrowserEvent('swal:confirm', [
                'type'      => 'warning',
                'text'      => "This .'$this->icno '. already exits!!!",
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
