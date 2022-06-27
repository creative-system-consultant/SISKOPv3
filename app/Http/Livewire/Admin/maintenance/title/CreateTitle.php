<?php

namespace App\Http\Livewire\Admin\maintenance\title;

use App\Models\Ref\RefCustTitle;
use Livewire\Component;

class CreateTitle extends Component
{
    public $title_description;
    public $title_code;
    public $title_status;
    public $title;

    public function submit()
    {
        $this->validate([
            'title_description' => ['required', 'string'],
            'title_code'        => ['required', 'string'],
        ]);

        $title = RefCustTitle::create([
            'description' => $this->title_description,
            'code'        => $this->title_code,
            'status'      => $this->title_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Title Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('title.list');
    }

    public function render()
    {
        return view ('maintenance.title.create')->extends('layouts.head');
    }
}
