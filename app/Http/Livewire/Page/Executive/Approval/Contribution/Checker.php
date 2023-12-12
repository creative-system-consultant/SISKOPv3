<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Approval;
use App\Models\Contribution;
use App\Models\User;
use Livewire\Component;

class Checker extends Component
{
    public User $User;
    public Approval $Approval;
    public $Checker;
    public $forward = FALSE;

    protected $rules = [
        'Approval.note'     => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        $this->Checker->step++;
        $this->Checker->save();
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
        if ($this->Checker->step > 1){
            $this->Checker->step--;
            $this->Checker->save();

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
        $this->Checker  = Contribution::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
            ['approval_id', $this->Checker->id],
            ['order', $this->Checker->step],
            ['role_id', '2'],
            ['approval_type', 'App\Models\Contribution'],
        ])->firstOrFail();
        $this->forward  = $this->Approval->rule_forward ?? FALSE;
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.checker')->extends('layouts.head');
    }
}
