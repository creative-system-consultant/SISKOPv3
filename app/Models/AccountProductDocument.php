<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountProductDocument extends Model
{

    protected $table   = "SISKOP.Account_Product_document";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(AccountProduct::class,'product_id','id');
    }
}
