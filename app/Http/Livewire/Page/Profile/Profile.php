<?php

namespace App\Http\Livewire\Page\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $profile_img = null;

    public function render()
    {
        return view('livewire.page.profile.profile');
    }
}
