<?php

namespace App\Http\Livewire\Page\Executive\Approval\Contribution;

use App\Models\Approval;
use App\Models\Contribution;
use App\Models\User;
use Livewire\Component;

class ContributionApproval extends Component
{
    public User $User;
    public Approval $Approval;
    public $approver;

    protected $rules = [
        'Approval.note'     => 'required',
    ];

    public function next()
    {
        $this->validate();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = 'lulus';
        $this->Approval->save();
        $mes ='Application VOTED APPROVED' ;

        if ($this->approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            $this->approver->flag = 20;
            $mes = 'Application APPROVED';
        }
        $this->approver->save();

        session()->flash('message', $mes);
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
                'timer' => 3500,
            ]);
        }
    }

    public function refuse()
    {
        $this->validate();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = 'lulus';
        $this->Approval->save();
        $mes ='Application VOTED REFUSE' ;

        if ($this->approver->approvals()->where('type','like','vote%')->whereNull('vote')->count() < 1){
            $this->approver->flag = 23;
            $mes = 'Application REFUSED';
        }
        $this->approver->save();

        session()->flash('message', $mes);
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => '4']);
    }

    public function mount($uuid)
    {
        $this->User     = User::find(auth()->user()->id);
        $this->approver  = Contribution::where('uuid', $uuid)->with('customer')->first();
        $this->Approval = Approval::where([
            ['approval_id', $this->approver->id],
            ['order', $this->approver->step],
            ['user_id', $this->User->id],
            ['approval_type', 'App\Models\Contribution'],
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.contribution.contribution-approval')->extends('layouts.head');
    }
}
