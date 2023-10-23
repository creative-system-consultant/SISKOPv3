<?php

namespace App\Http\Livewire\Page\Profile;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Auth;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    // public $Uid;
    public User $User;
    public Customer $Cust;

    protected $rules = [
        'User.name'     => ['required', 'string'],
        'User.icno'     => ['required', 'string'],
        'User.phone_no' => ['required', 'string'],
        'User.email'    => ['required', 'string'],
    ];

    public function submit()
    {
        $this->User->save();

        $this->Cust->name   = $this->User->name;
        $this->Cust->icno   = $this->User->icno;
        $this->Cust->mobile_num = $this->User->phone_no;
        $this->Cust->save();

        session()->flash('message', 'Profile Details Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('Index');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->Cust = Customer::firstOrCreate([
            'icno'      => $this->User->icno,
            'client_id'   => $this->User->client_id,
        ],[
            'name'      => $this->User->name,
            'mobile_num'=> $this->User->phone_no,
        ]);
    }

    public function render()
    {
        return view('livewire.page.profile.profile')->extends('layouts.head');
    }
}
