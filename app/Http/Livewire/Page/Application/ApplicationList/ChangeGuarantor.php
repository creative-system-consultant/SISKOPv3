<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ChangeGuarantor as ModelsChangeGuarantor;
use App\Models\ChangeGuarantorDetails;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ChangeGuarantor extends Component
{
    use WithPagination;
    public User $User;
    public $Change;
    public $ChangeGuarantorsDetails;

    public function clearApplication()
    {
        $this->Change = new ModelsChangeGuarantor();
    }

    public function showApplication($uuid)
    {
        $this->Change = ModelsChangeGuarantor::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        $this->ChangeGuarantorsDetails = ChangeGuarantorDetails::where('apply_id', $this->Change->id)->where('client_id', $this->User->client_id)->with('customer')->get();
    }

    public function remake_approvals()
    {
        $this->ChangeGuarantors->remove_approvals();
        $this->ChangeGuarantors->make_approvals();
        $this->ChangeGuarantors->step = 1;
        $this->ChangeGuarantors->save();

        $this->dispatchBrowserEvent('swal', [
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
    }

    public function render()
    {
        $ChangeGuarantors = ModelsChangeGuarantor::where('client_id', $this->User->client_id)->orderBy('created_at', 'desc')->with('customer')->paginate(5);
        return view('livewire.page.application.application-list.changeguarantor',[
            'ChangeGuarantors' => $ChangeGuarantors,
        ]);
    }
}
