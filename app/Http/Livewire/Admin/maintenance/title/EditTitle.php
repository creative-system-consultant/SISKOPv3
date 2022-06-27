<?php

namespace App\Http\Livewire\Admin\maintenance\title;

use Livewire\Component;
use App\Models\Ref\RefCustTitle;

class EditTitle extends Component
{
    public $title_description;
    public $title_code;
    public $title_status;
    public $title;

    public function submit($id)
    {
        $this->validate([
            'title_description' => ['required', 'string'],
            'title_code'        => ['required', 'string'],
        ]);

        $title = RefCustTitle::where('id', $id)->first();

        $title->update([
            'description' => $this->title_description,
            'code'        => $this->title_code,
            'status'      => $this->title_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Title Edited');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('title.list'); 
    }

    public function load($id)
    {
        $title = RefCustTitle::where('id', $id)->first();          

        $this->title_description    = $title->description; 
        $this->title_code           = $title->code;
        $this->title_status         = $title->status == true ? 'checked' : '';
    }
    
    public function mount($id)
    {
        $this->title = RefCustTitle::where('id', $id)->first();

        $this->load($id);
    }

    public function render()
    {
        return view ('maintenance.title.edit')->extends('layouts.head');
    }
}