<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Guarantor extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.GUARANTORS";
    protected $guarded = ['uuid'];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function data()
    {
        return $this->belongsTo(Customer::class,'guarantor_cust_id');
    }

    public function guarantee()
    {
        return $this->morphTo();
    }
}