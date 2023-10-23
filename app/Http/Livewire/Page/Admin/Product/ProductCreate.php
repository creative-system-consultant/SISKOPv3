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

class ProductCreate extends Component
{
    use WithFileUploads;

    public User $User;
    public AccountProduct $Product;
    public $producttype;
    public $brochure;
    public $payment_table;
    public $refdocument;
    public $document = [];
    public $documentlist = [];

    protected $rules = [
        'Product.name'               => ['required', 'string'],
        'Product.product_type'       => ['required', 'integer'],
        'Product.profit_rate'        => ['required', 'numeric', 'lte:100'],
        'Product.amt_min'            => ['required', 'numeric', 'lte:Product.amt_max', 'gt:0'],
        'Product.amt_max'            => ['required', 'numeric', 'gte:Product.amt_min'],
        'Product.term_min'           => ['required', 'integer', 'lte:Product.term_max'],
        'Product.term_max'           => ['required', 'integer', 'gte:Product.term_min'],
        'Product.apply_limit'        => ['required', 'integer'],
        'Product.apply_lifetime'     => [ 'integer'],
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
        'Product.name'          => 'Name',
        'Product.product_type'  => 'Product Type',
        'Product.profit_rate'   => 'Profit Rate',
        'Product.amt_min'       => 'Minimum Financing',
        'Product.amt_max'       => 'Maximum Financing',
        'Product.term_min'      => 'Minimum term',
        'Product.term_max'      => 'Maximum term',
    ];


    public function mount()
    {
        $this->User = auth()->user();

        $this->Product = New AccountProduct;

        $this->producttype = RefProductType::all();

        $this->refdocument = RefProductDocuments::where('client_id', $this->User->client_id)->get();

    }
    public function deb()
    {
        dd($this->Product);
    }

    public function enableDoc($num,$code,$name)
    {
        // dd($num);

        // $document = AccountProductDocument::Create([
        //     'product_id'    => $this->Product->id,
        //     'client_id'       => $this->User->client_id,
        //     'type'          => $code,
        //     'name'          => $name,
        // ]);

        // $document->update([
        //     'status'    => !$document->status,
        // ]);

        $this->document[$num-1] = New AccountProductDocument;
        $this->document[$num-1]->client_id = $this->User->client_id;
        $this->document[$num-1]->type = $code;
        $this->document[$num-1]->name = $name;
        $this->document[$num-1]->status = !$this->document[$num-1]->status;

    }

    public function submit()
    {

        $this->validate();

        $this->Product->client_id = $this->User->client_id;
        $this->Product->save();

        $coop = Auth()->user()->client_id;

        //brochure file
        if($this->brochure){

            $filepath = 'Files/'.$coop.'/Financing/product/'.$this->Product->id.'/'.'brochure.'.$this->brochure->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $coop. '/financing/product//'.$this->Product->id, $this->brochure, 'brochure'.'.'.$this->brochure->extension());

            $this->Product->files()->create([
                'filename' => 'brochure',
                'filedesc' => 'Brochure',
                'filetype' => $this->brochure->extension(),
                'filepath' => $filepath,
            ]);
        };


         //payment file
         if($this->payment_table){

            $filepath = 'Files/'.$coop.'/Financing/product/'.$this->Product->id.'/'.'payment_table.'.$this->payment_table->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $coop. '/financing/product//'.$this->Product->id, $this->payment_table, 'payment_table'.'.'.$this->payment_table->extension());

            $this->Product->files()->create([
                'filename' => 'payment_table',
                'filedesc' => 'Payment Table',
                'filetype' => $this->payment_table->extension(),
                'filepath' => $filepath,
            ]);
         };

        // dd($filepath);

        foreach ($this->document as $key => $value) {
            $this->Product->documents()->create($value);
        }

        session()->flash('message', 'Product Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('product.list');
    }

    public function render()
    {
        return view('livewire.page.admin.product.create')->extends('layouts.head');
    }
}
