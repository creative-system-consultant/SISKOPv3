<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Contribution extends Component
{
    use WithPagination;
    public User $User;
    public $client_id;
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
        $this->client_id = $this->User->client_id;
    }

    public function render()
    {
        $contributions = ApplyContribution::where('client_id', $this->client_id)->where('direction', 'buy')->where('flag', '!=', 0)->orderBy('created_at','desc')->with('customer')->paginate(5);
        return view('livewire.page.application.application-list.contribution',[
            'contributions' => $contributions,
        ]);
    }
}
