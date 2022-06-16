<?php

namespace App\Http\Livewire\Auth;

use App\Mail\RetrieveAccountEmail;
use App\Models\User;
use Livewire\Component;
use Mail;

class RetrieveAccount extends Component
{
    public $icno;

    public function sendRetreiveAccountLink()
    {
        $this->validate([
            'icno' => ['required', 'numeric']
        ]);  
        
        $user = User::where('icno', $this->icno)->first();
        
        $mail = Mail::to($user->email)->send(new RetrieveAccountEmail($user));

        if ($mail) {
            session()->flash('accountMessage', 'We have emailed your retrieve account link!');

            return;
        }

        $this->addError('icno', trans($mail));
    }

    public function render()
    {
        return view('livewire.auth.retrieve-account');
    }
}
