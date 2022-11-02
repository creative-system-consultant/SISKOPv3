<?php

namespace App\Http\Livewire\Page\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AccountSetting extends Component
{
    /** @var string */
    public $old_pass = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $confirm_password = '';

    public function changePassword()
    {
        $this->validate([
            'old_pass'      => ['required', 'string'],
            'password'  => ['required', 'min:8', 'same:confirm_password'],
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        if ($this->password == Hash::check($this->old_pass, $user->password)) {
            $user->update([
                'password' => Hash::make($this->password),
            ]);
        }
        else{
            session()->flash('message', 'The provided password does not match your current password.');
            session()->flash('error');
            session()->flash('title');

            return redirect()->route('profile');
        }

        session()->flash('message', 'Password Changed');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.page.profile.account-setting');
    }
}
