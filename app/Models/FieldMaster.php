<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldMaster extends Model
{
    use SoftDeletes;

    protected $table   = 'SISKOP.SYS_FIELD_MASTER';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    
}
