<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefProductDocuments extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.product_documents';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

}
