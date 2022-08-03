<?php

namespace App\Http\Livewire\Page\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ref\RefProductType;
use App\Models\AccountProduct;
use App\Models\Customer;
use Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public $Product;
    public $producttype;
    public $name;
    public $type;
    public $rate;
    public $minfin;
    public $maxfin;
    public $minterm;
    public $maxterm;
    public $brochure;
    public $payment_table;

    protected $rules = [
        'name'              => ['required', 'string'],
        'type'              => ['required', 'integer'],
        'rate'              => ['required', 'numeric'],
        'minfin'            => ['required','gt:0', 'numeric'],
        'maxfin'            => ['required', 'numeric'],
        'minterm'           => ['required', 'integer'],
        'maxterm'           => ['required', 'integer'],
    ]; 
    
    protected $messages = [
        'name.required'          => ':attribute is required',
        'type.required'          => ':attribute is required', 
        'rate.required'          => ':attribute is required',
        'minfin.required'        => ':attribute is required',
        'minfin.gt'              => 'Application must be more than RM0',
        'maxfin.required'        => ':attribute is required',
        'minterm.required'       => ':attribute is required',
        'maxterm.required'       => ':attribute is required',
    ];

    protected $validationAttributes = [
        'name'       => 'Name', 
        'type'       => 'Product Type', 
        'rate'       => 'Profit Rate',
        'minfin'     => 'Minimum Financing',
        'maxfin'     => 'Maximum Financing',
        'minterm'    => 'Minimum term',
        'maxterm'    => 'Maximum term',
    ];
    
    public function submit($id)
    {
        //  dd($this->name, $this->type, $this->rate, $this->minfin, $this->maxfin, $this->minterm, $this->maxterm,);

        $this->validate();

        $Product = AccountProduct::where('id', $id)->first();

        $Product->update([
            'coop_id'         => Auth()->user()->coop_id,
            'name'            => trim(strtoupper($this->name)),
            'product_type'    => $this->type,
            'profit_rate'     => $this->rate,
            'amt_min'         => $this->minfin,
            'amt_max'         => $this->maxfin,
            'term_min'        => $this->minterm,
            'term_max'        => $this->maxterm,
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);
        //dd($Product);

        $user = Auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();

        if($this->brochure){
            $filepath = 'Files/'.$customer->id.'/Financing/brochure/'.'.'.$this->brochure->extension(); 

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/financing//'.$this->Product->id, $this->brochure, 'brochure'.'.'.$this->brochure->extension());

            $this->Product->files()->updateOrCreate([
                'filename' => 'brochure',
                'filedesc' => 'Brochure',
                'filetype' => $this->brochure->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->payment_table){
            $filepath = 'Files/'.$customer->id.'/Financing/payment_table/'.'.'.$this->payment_table->extension(); 

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/financing//'.$this->Product->id, $this->payment_table, 'payment_table'.'.'.$this->payment_table->extension());
    
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

    public function loadProduct($id)
    {
        $Product = AccountProduct::where('id', $id)->first();

        $this->name      = $Product->name;
        $this->type      = $Product->product_type;
        $this->rate      = $Product->profit_rate;
        $this->minfin    = $Product->amt_min;
        $this->maxfin    = $Product->amt_max;
        $this->minterm   = $Product->term_min;
        $this->maxterm   = $Product->term_max;
    }

    public function mount($id)
    {
        $this->Product = AccountProduct::where('id', $id)->first();
        $this->producttype_id = RefProductType::all();
        $this->loadProduct($id);
    }

    public function render()
    {
        return view('livewire.page.product.productedit')->extends('layouts.head');
    }
}
