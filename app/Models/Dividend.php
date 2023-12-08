<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Dividend extends Model implements Auditable
{
    use HasCoop;
    use HasCustomer;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "FMS.DIVIDEND_FINAL";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
