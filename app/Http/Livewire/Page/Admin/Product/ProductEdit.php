<?php

namespace App\Http\Livewire\Page\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ref\RefProductType;
use App\Models\AccountProduct;
use App\Models\AccountProductDocument;
use App\Models\Ref\RefFinCalcType;
use App\Models\Ref\RefProductDocuments;
use App\Models\User;
use Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public User $User;
    public AccountProduct $Product;
    public $loanType;
    public $producttype;
    public $brochure;
    public $brochure_file;
    public $payment_table;
    public $payment_table_file;
    public $refdocument;
    public $document = [];
    public $documentlist = [];
    public $page = "Edit";

    protected $rules = [
        'Product.name'           => ['required', 'string'],
        'Product.fin_type'       => ['required', 'integer'],
        'Product.product_type'   => ['required', 'integer'],
        'Product.profit_rate'    => ['required', 'numeric', 'lte:100'],
        'Product.amt_min'        => ['required', 'numeric', 'lte:Product.amt_max', 'gt:0'],
        'Product.amt_max'        => ['required', 'numeric', 'gte:Product.amt_min'],
        'Product.term_min'       => ['required', 'integer', 'lte:Product.term_max'],
        'Product.term_max'       => ['required', 'integer', 'gte:Product.term_min'],
        'Product.apply_limit'    => ['required', 'integer'],
        'Product.apply_lifetime' => ['integer'],
        'Product.process_fee'    => ['required', 'numeric', 'gte:0'],
        'Product.takaful_percentage' => ['required', 'numeric', 'gte:0'],
        'Product.bank_charge' => ['required', 'numeric', 'gte:0'],
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
        'Product.fin_type'       => 'Financing Calculation Type',
        'Product.product_type'   => 'Product Type',
        'Product.profit_rate'    => 'Profit Rate',
        'Product.amt_min'        => 'Minimum Financing',
        'Product.amt_max'        => 'Maximum Financing',
        'Product.term_min'       => 'Minimum term',
        'Product.term_max'       => 'Maximum term',
    ];

    public function mount($id = NULL)
    {
        $this->User = auth()->user();

        if ($id == NULL){
            $this->Product = new AccountProduct;
            $this->page = "Create";
        } else {
            $this->Product = AccountProduct::where('id', $id)->first();
        }

        $this->producttype        = RefProductType::all();
        $this->refdocument        = RefProductDocuments::get();
        $this->brochure_file      = $this->Product->files()->where('filename', 'brochure')->first();
        $this->payment_table_file = $this->Product->files()->where('filename', 'payment_table')->first();
        $this->loanType           = RefFinCalcType::where('client_id', $this->User->client_id)->get();
    }

    public function enableDoc($code,$name)
    {
        $this->document = AccountProductDocument::firstOrCreate([
            'product_id' => $this->Product->id,
            'client_id'  => $this->User->client_id,
            'type'       => $code,
            'name'       => $name,
        ]);

        $this->document->update([
            'status'    => !$this->document->status,
        ]);
    }

    public function submit()
    {

        $this->validate();

        $this->Product->client_id = $this->User->client_id;
        $this->Product->save();

        $coop = Auth()->user()->client_id;

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
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('product.list');
    }

    public function render()
    {
        return view('livewire.page.admin.product.edit')->extends('layouts.head');
    }
}
