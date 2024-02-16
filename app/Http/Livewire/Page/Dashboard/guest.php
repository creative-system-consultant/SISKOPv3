<?php

namespace App\Http\Livewire\Page\Dashboard;

use App\Models\Client;
use App\Models\Coop;
use App\Models\User;
use App\Models\UserClient;
use DB;
use Livewire\Component;

class Guest extends Component
{
    public Coop $Coop;
    public User $User;
    public $userclient;
    public $clients;
    public $userclientid;

    public function mount()
    {
        $this->User = User::find(auth()->User()->id);
        $this->userclient = $this->User->user_client;
        $this->userclientid = explode(',', DB::table('ref.USER_HAS_CLIENTS')->select('client_id')->where('user_id', $this->User->id)->get()->implode('client_id', ','));
        $this->clients = Client::where('id', '>', '2')->whereNotIn('id', $this->userclientid)->orderbyRaw("type_id asc, name2 asc")->get();
    }

    public function select($id)
    {
        session()->forget('just_logged_in');

        $client = Client::where('id', $id)->first();
        if ($client != NULL) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text'  => 'Success Message',
                'icon'  => 'success',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);

            $this->User->client_id = $client->id;
            $this->User->save();

            return redirect(route('home'));
        }
    }

    public function reg($id)
    {
        session()->forget('just_logged_in');

        $client = Client::where('id', $id)->first();
        if ($client != NULL) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Success!',
                'text'  => 'Success Message',
                'icon'  => 'success',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);

            $this->User->client_id = $client->id;
            $this->User->save();

            return redirect(route('membership.apply'));
        }
    }

    public function deb()
    {
        dd([
            'User'         => $this->User,
            'Userclients'  => $this->userclient,
            'Clients'      => $this->clients,
            'userclientid' => $this->userclientid,
        ]);
    }

    public function render()
    {
        return view('livewire.page.dashboard.guest')->extends('layouts.head');
    }
}
