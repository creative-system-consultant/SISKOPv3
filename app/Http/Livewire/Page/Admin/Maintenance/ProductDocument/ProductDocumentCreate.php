<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\ProductDocument;

use App\Models\Ref\RefProductDocuments;
use App\Models\User;
use Livewire\Component;

class ProductDocumentCreate extends Component
{
    public User $User;
    public $description;
    public $code;
    public $status;
    public $RefProductDocument;

    public function submit()
    {
        $this->validate([
            'description'       => ['required', 'string'],
            'code'              => ['required', 'string'],
        ]);

        $this->RefProductDocument = RefProductDocuments::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            //'client_id'       => $this->User->client_id,
            'created_at'      => now(),
            'created_by'      => $this->User->id,
        ]);

        session()->flash('message', 'Product Document Created');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('ProductDocument.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.productdocument.productdocumentcreate')->extends('layouts.head');
    }
}