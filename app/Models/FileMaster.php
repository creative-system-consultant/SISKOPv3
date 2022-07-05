<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FileMaster extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'SISKOP.FILE_MASTER';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
