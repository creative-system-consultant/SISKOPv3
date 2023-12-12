<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;

class GenderEdit extends Component
{

        public $description;
        public $code;
        public $status;
        public $RefGender;

        public function submit($id)
        {
        $this->validate([
            'description'    => ['required', 'string'],
            'code'           => ['required', 'string'],
        ]);

        $RefGender = RefGender::where('id', $id)->first();

        $RefGender->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->id(),
        ]);

        session()->flash('message', 'Gender Details Updated');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('gender.list');
    }

    public function  loadUser($id)
    {
        $RefGender = RefGender::where('id', $id)->first();

        $this->description  = $RefGender->description;
        $this->code         = $RefGender->code;
        $this->status       = $RefGender->status == true ? 'checked' : '';
    }

    public function mount($id)
    {
        $this->RefGender = RefGender::where('id', $id)->first();

        $this->loadUser($id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.genderedit')->extends('layouts.head');
    }

}
