<?php

namespace App\Http\Livewire\Page;

use App\Models\Client;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public Client $Client;
    public User $User;

    public function mount(){
        $this->User = User::find(auth()->User()->id);
        $this->Client = Client::where('id', $this->User->client_id)->first();
    }

    public function logout() {
        $this->User->client_id = NULL;
        $this->User->save();

        return redirect(route('dash.guest'));
    }

    public function render()
    {
        return view('livewire.page.home')->extends('layouts.head');
    }
}
