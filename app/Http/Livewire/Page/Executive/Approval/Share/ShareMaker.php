<?php

namespace App\Http\Livewire\Page\Executive\Approval\Share;

use App\Models\Approval;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class ShareMaker extends Component
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

        return redirect()->route('application.list',['page' => '2']);
    }

    public function back()
    {
        if ($this->maker->step > 1){
            $this->maker->step--;
            $this->maker->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => '2']);
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
       $this->User      = User::find(auth()->user()->id);
       $this->maker     = Share::where('uuid', $uuid)->with('customer')->first();
       $this->banks     = RefBank::where('client_id', $this->maker->client_id)->get();
       $this->Approval  = Approval::where([
            ['approval_id', $this->maker->id],
            ['order', $this->maker->step],
            ['role_id', '1'],
            ['approval_type', 'App\Models\Share'],
        ])->firstOrFail();
        //dd($this->maker->approvals);
    }

    public function render()
    {
        return view('livewire.page.executive.approval.share.share-maker')->extends('layouts.head');
    }
}
