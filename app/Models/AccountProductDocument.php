<?php

namespace App\Models;

use App\Models\Ref\RefProductDocuments;
use Illuminate\Database\Eloquent\Model;

class AccountProductDocument extends Model
{

    protected $table   = "SISKOP.Account_Product_document";
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

    public function document()
    {
        return $this->belongsTo(RefProductDocuments::class,'type','code');
    }
}
