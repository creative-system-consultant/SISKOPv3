<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ComponentDoc extends Component
{

    public function submit (){

        $this->dispatchBrowserEvent('swal',[
            'title' => 'Success!',
            'text'  => 'Success Message',
            'icon'  => 'success',
            'showConfirmButton' => false,
            'timer' => 1500,
        ]);
    }

    public function submit2 (){

        session()->flash('message', 'Success Message');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('doc');
    }

    public function render()
    {
        return view('livewire.component-doc')->extends('doc.doc-head');
    }
}
