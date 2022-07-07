<?php

namespace App\Http\Livewire\Admin\maintenance\title;

use Livewire\Component;
use App\Models\Ref\RefCustTitle;

class ListTitle extends Component
{

    public $title;

    public function mount()
    {
        $this->title = RefCustTitle::get();
    }

    public function delete($id)
    {
        $data = RefCustTitle::find($id);
        $data->delete();

        session()->flash('message', 'Title Deleted');
        session()->flash('success');
        session()->flash('title', 'Success!');

        return redirect()->route('title.list');
    }

    public function render()
    {
        return view ('livewire.admin.maintenance.title.index')->extends('layouts.head');
    }

}