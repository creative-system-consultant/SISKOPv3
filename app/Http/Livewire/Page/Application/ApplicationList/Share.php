<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Share as ApplyShare;
use App\Models\User;
use Livewire\Component;

class Share extends Component
{
    public User $User;
    public ApplyShare $share;
    public $shares;

    public function clearApplication()
    {
        $this->share = new ApplyShare;
    }

    public function showApplication($uuid)
    {
        $this->share = ApplyShare::where('uuid', $uuid)->with('customer')->first();
    }

    public function mount()
    {
        $this->User   = User::find(auth()->user()->id);
        $this->shares = ApplyShare::where([['direction', 'buy'],['coop_id', $this->User->coop_id]])->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.share');
    }
}
