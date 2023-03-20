<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyDividend;
use App\Models\User;
use Livewire\Component;

class Dividend extends Component
{
    public User $User;
    public ApplyDividend $dividend;
    public $dividends;

    public function clearApplication()
    {
        $this->dividend = new ApplyDividend;
    }

    public function showApplication($uuid)
    {
        $this->dividend = ApplyDividend::where('uuid', $uuid)->with('customer')->first();
    }

    public function mount()
    {
        $this->User      = User::find(auth()->user()->id);
        $this->dividends = ApplyDividend::where([['coop_id', $this->User->coop_id]])->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.dividend');
    }
}
