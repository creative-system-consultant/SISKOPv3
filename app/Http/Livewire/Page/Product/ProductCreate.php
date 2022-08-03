<?php

namespace App\Http\Livewire\Page\Product;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ref\RefProductType;
use App\Models\AccountProduct;
use Storage;

class ProductCreate extends Component
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
        'name.required'          => 'Product Name is required',
        'type.required'          => 'Product Type is required', 
        'rate.required'          => 'Profit Rate required',
        'minfin.required'        => 'Minimum Financing required',
        'minfin.gt'              => 'Application must be more than RM0',
        'maxfin.required'        => 'Maximum Financing required',
        'minterm.required'       => 'Minimum Term is required',
        'maxterm.required'       => 'Maximum Term is required',
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

    public function submit()
    {
        //  dd($this->name, $this->type, $this->rate, $this->minfin, 
        //      $this->maxfin, $this->minterm, $this->maxterm,);

        $this->validate();

        $this->Product = AccountProduct::create([
            'coop_id'         => Auth()->user()->coop_id,
            'name'            => trim(strtoupper($this->name)),
            'product_type'    => $this->type,
            'profit_rate'     => $this->rate,
            'amt_min'         => $this->minfin,
            'amt_max'         => $this->maxfin,
            'term_min'        => $this->minterm,
            'term_max'        => $this->maxterm,
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        $user = Auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();

        //brochure file
        if($this->brochure){
            
            $filepath = 'Files/'.$customer->id.'/Financing/brochure/'.'.'.$this->brochure->extension(); 

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/financing//'.$this->Product->id, $this->brochure, 'brochure'.'.'.$this->brochure->extension());

            $this->Product->files()->create([
                'filename' => 'brochure',
                'filedesc' => 'Brochure',
                'filetype' => $this->brochure->extension(),
                'filepath' => $filepath,
            ]);
        };
        

         //payment file
         if($this->payment_table){
            
            $filepath = 'Files/'.$customer->id.'/Financing/payment_table/'.'.'.$this->payment_table->extension(); 

            Storage::disk('local')->putFileAs('public/Files/' . $customer->id. '/financing//'.$this->Product->id, $this->payment_table, 'payment_table'.'.'.$this->payment_table->extension());

            $this->Product->files()->create([
                'filename' => 'payment_table',
                'filedesc' => 'Payment Table',
                'filetype' => $this->payment_table->extension(),
                'filepath' => $filepath,
            ]);
         };

        // dd($filepath);

        session()->flash('message', 'Product Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('product.list');
    }

    
    public function mount()
    {
        $this->producttype_id = RefProductType::all();
    }

    public function render()
    {
        return view('livewire.page.product.productcreate')->extends('layouts.head');
    }
}
