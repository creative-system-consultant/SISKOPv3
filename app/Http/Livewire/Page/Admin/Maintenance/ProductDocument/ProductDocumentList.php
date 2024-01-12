<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\ProductDocument;

use Livewire\Component;
use App\Models\Ref\RefProductDocuments;

class ProductDocumentList extends Component
{
    public $RefProductDocuments;

    public function mount()
    {
        $this->RefProductDocuments = RefProductDocuments::where('client_id', NULL)->get();
    }

    public function delete($id)
    {
        $data=RefProductDocuments::find($id);
        $data->delete();

        session()->flash('message', 'Product Document Record Deleted');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('productdocument.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.productdocument.productdocument')->extends('layouts.head');
    }
}

