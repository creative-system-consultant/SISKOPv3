<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefCoopType extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.coop_types';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
}
