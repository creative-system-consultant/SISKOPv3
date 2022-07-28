<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMaster extends Model
{
    use SoftDeletes;

    protected $table   = 'SISKOP.FILE_MASTER';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
