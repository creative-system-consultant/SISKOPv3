<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Approval;
use App\Models\Contribution;
use App\Models\User;
use Livewire\Component;

class ContributionCommittee extends Component
{
    public User $User;
    public Approval $Approval;
    public $committee;

    protected $rules = [
        'Approval.note'     => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        $this->checker->step++;
        $this->checker->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = 'lulus';
        $this->Approval->save();

        session()->flash('message', 'Application Pre-Approved');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '4']);
    }

    public function back()
    {
        if ($this->checker->step > 1){
            $this->checker->step--;
            $this->checker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => '4']);
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 10000,
            ]);
        }
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->committee  = Contribution::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
            ['approval_id', $this->committee->id],
            ['order', $this->committee->step],
            ['user_id', $this->User->id],
            ['approval_type', 'App\Models\Contribution'],
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-committee')->extends('layouts.head');
    }
}
