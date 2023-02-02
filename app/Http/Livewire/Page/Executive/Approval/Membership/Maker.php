<?php

namespace App\Http\Livewire\Page\Executive\Approval\Membership;

use App\Models\ApplyMembership;
use App\Models\Approval;
use App\Models\User;
use Livewire\Component;

class Maker extends Component
{
    public User $User;
    public Approval $Approval;
    public $maker;
    public $banks;

    protected $rules = [
        'Approval.note'     => 'required|max:255',
    ];

    public function next()
    {
        $this->validate();
        $this->maker->step++;
        $this->maker->save();
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
        if ($this->maker->step > 1){
            $this->maker->step--;
            $this->maker->save();

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
        $this->maker    = ApplyMembership::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
                            ['approval_id', $this->maker->id],
                            ['order', $this->maker->step],
                            ['role_id', '1'],
                            ['approval_type', 'App\Models\ApplyMembership'],
                        ])->firstOrFail();
    }

    public function render()
    {
        /* dd([
            'roles'     => $this->User->role_ids(),
            'approvals' => $this->maker->approvals,
            'approval'  => $this->Approval, 
            'maker'     => $this->maker,
        ]); */
        return view('livewire.page.executive.approval.membership.maker')->extends('layouts.head');
    }
}
