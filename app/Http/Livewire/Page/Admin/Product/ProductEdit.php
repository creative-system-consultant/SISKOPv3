<?php

namespace App\Http\Livewire\Page\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ref\RefProductType;
use App\Models\AccountProduct;
use App\Models\AccountProductDocument;
use App\Models\Ref\RefProductDocuments;
use App\Models\User;
use Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public User $User;
    public AccountProduct $Product;
    public $producttype;
    public $brochure;
    public $brochure_file;
    public $payment_table;
    public $payment_table_file;
    public $refdocument;
    public $document = [];
    public $documentlist = [];

    protected $rules = [
        'Product.name'               => 'required|string',
        'Product.product_type'       => 'required|integer',
        'Product.profit_rate'        => ['required', 'numeric', 'lte:100'],
        'Product.amt_min'            => ['required', 'numeric', 'lte:Product.amt_max', 'gt:0'],
        'Product.amt_max'            => ['required', 'numeric', 'gte:Product.amt_min'],
        'Product.term_min'           => ['required', 'integer', 'lte:Product.term_max'],
        'Product.term_max'           => ['required', 'integer', 'gte:Product.term_min'],
        'Product.apply_limit'        => ['required', 'integer'],
        'Product.apply_lifetime'     => ['integer'],
    ];

    protected $messages = [
        'Product.name.required'           => ':attribute is required',
        'Product.product_type.required'   => ':attribute is required',
        'Product.profit_rate.required'    => ':attribute is required',
        'Product.amt_min.required'        => ':attribute is required',
        'Product.amt_min.gt'              => 'Application must be more than RM0',
        'Product.amt_max.required'        => ':attribute is required',
        'Product.term_min.required'       => ':attribute is required',
        'Product.term_max.required'       => ':attribute is required',
    ];

    protected $validationAttributes = [
        'Product.name'           => 'Name',
        'Product.product_type'   => 'Product Type',
        'Product.profit_rate'    => 'Profit Rate',
        'Product.amt_min'        => 'Minimum Financing',
        'Product.amt_max'        => 'Maximum Financing',
        'Product.term_min'       => 'Minimum term',
        'Product.term_max'       => 'Maximum term',
    ];

    public function mount($id)
    {
        $this->User = auth()->user();
        $this->Product            = AccountProduct::where('id', $id)->first();
        $this->producttype_id     = RefProductType::all();
        $this->refdocument        = RefProductDocuments::where('coop_id', $this->User->coop_id)->get();
        $this->brochure_file      = $this->Product->files()->where('filename', 'brochure')->first();
        $this->payment_table_file = $this->Product->files()->where('filename', 'payment_table')->first();
    }

    public function enableDoc($code,$name)
    {
        $this->document = AccountProductDocument::firstOrCreate([
            'product_id'    => $this->Product->id,
            'coop_id'       => $this->User->coop_id,
            'type'          => $code,
            'name'          => $name,
        ]);

        $this->document->update([
            'status'    => !$this->document->status,
        ]);
    }

    public function submit($id)
    {

        $this->validate();

        $this->Product->coop_id = $this->User->coop_id;
        $this->Product->save();

        $coop = Auth()->user()->coop_id;

        if($this->brochure){
            $filepath = 'Files/'.$coop.'/Financing/product/'.$this->Product->id.'/'.'brochure.'.$this->brochure->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $coop. '/financing/product//'.$this->Product->id, $this->brochure, 'brochure'.'.'.$this->brochure->extension());

            $this->Product->files()->updateOrCreate([
                'filename' => 'brochure',
                'filedesc' => 'Brochure',
                'filetype' => $this->brochure->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->payment_table){
            $filepath = 'Files/'.$coop.'/Financing/product/'.$this->Product->id.'/'.'payment_table.'.$this->payment_table->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $coop. '/financing/product//'.$this->Product->id, $this->payment_table, 'payment_table'.'.'.$this->payment_table->extension());

            $this->Product->files()->updateOrCreate([
                'filename' => 'payment_table',
                'filedesc' => 'Payment Table',
                'filetype' => $this->payment_table->extension(),
                'filepath' => $filepath,
            ]);
        };

        session()->flash('message', 'Product Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('product.list');
    }

    public function render()
    {
        return view('livewire.page.admin.product.edit')->extends('layouts.head');
    }
}
