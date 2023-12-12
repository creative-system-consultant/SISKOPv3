<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\User;
use Livewire\Component;

class Contribution extends Component
{
    public User $User;
    public $contributions;
    public $Contribution;

    public function clearApplication()
    {
        $this->Contribution = NULL;
    }

    public function showApplication($uuid)
    {
        $this->Contribution = ApplyContribution::where('uuid', $uuid)->with('customer')->first();
    }

    public function remake_approvals()
    {
        $this->Contribution->remove_approvals();
        $this->Contribution->make_approvals('Contribution');
        $this->Contribution->flag = 1;
        $this->Contribution->step = 1;
        $this->Contribution->save();

        $this->dispatchBrowserEvent('swal',[
            'title' => 'Success!',
            'text'  => 'Approvals have been reset',
            'icon'  => 'success',
            'showConfirmButton' => false,
            'timer' => 360000,
        ]);
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->contributions = ApplyContribution::where('direction', 'buy')->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.contribution');
    }
}
