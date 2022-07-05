<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefAccountStatus extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.account_statuses';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

}
