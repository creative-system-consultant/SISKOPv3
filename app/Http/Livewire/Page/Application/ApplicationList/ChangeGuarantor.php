<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Http\Traits\HasApprovals;
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
    public $route;
    public $filter = '';

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

    public function mount($route)
    {
        $this->route = $route;
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $ChangeGuarantors = ModelsChangeGuarantor::where('client_id', $this->User->client_id)
                                                    ->where('flag', 1)
                                                    ->orderBy('created_at', 'desc')
                                                    ->with('customer')
                                                    ->paginate(5);
        } else {
            $ChangeGuarantorsQuery = ModelsChangeGuarantor::where('client_id', $this->User->client_id)
                                                ->where('flag', '!=', 0);

            if ($this->filter == 'process') {
                $ChangeGuarantorsQuery->where('flag', 1);
            } elseif ($this->filter == 'approved') {
                $ChangeGuarantorsQuery->where('flag', 20);
            } elseif ($this->filter == 'failed') {
                $ChangeGuarantorsQuery->where('flag', '>', 20);
            }

            $ChangeGuarantors = $ChangeGuarantorsQuery->orderBy('created_at', 'desc')
                                            ->with('customer')
                                            ->paginate(5);
        }

        return view('livewire.page.application.application-list.changeguarantor', [
            'ChangeGuarantors' => $ChangeGuarantors,
        ]);
    }
}
