<?php

namespace App\Models;

use App\Models\Ref\RefProductDocuments;
use Illuminate\Database\Eloquent\Model;

class AccountProductGuarantor extends Model
{

    protected $table   = "SISKOP.Account_Product_guarantor";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(AccountProduct::class,'product_id','id');
    }

}
