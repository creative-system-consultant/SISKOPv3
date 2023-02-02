<?php

namespace App\Http\Traits;

use App\Models\Customer;

trait HasCustomer
{
    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }
}
