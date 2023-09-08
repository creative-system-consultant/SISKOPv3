<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileMaster extends Model
{
    use SoftDeletes;

    protected $table   = 'SISKOP.FILE_MASTER';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
