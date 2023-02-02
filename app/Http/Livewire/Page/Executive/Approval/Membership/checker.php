<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Checker extends Component
{
    public User $User;
    public Approval $Approval;
    public $checker;
    public $banks;

    protected $rules = [
        'Approval.note'     => 'required',
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

        return redirect()->route('application.list');
    }

    public function back()
    {
        if ($this->checker->step > 1){
            $this->checker->step--;
            $this->checker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list');
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 3500,
            ]);
        }
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->checker  = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->checker->id],
                            ['order', $this->checker->step],
                            ['role_id', '2'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
    }

    public function render()
    {
        /* dd([
            'approvals' => $this->checker->approvals,
            'approval'  => $this->Approval, 
            'checker'     => $this->checker,
        ]); */
        return view('livewire.page.executive.approval.membership.checker')->extends('layouts.head');
    }
}
