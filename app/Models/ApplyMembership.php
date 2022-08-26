<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ApplyMembership extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.APPLY_MEMBERSHIP";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function introducers()
    {
        return $this->morphMany(introducer::class,'introduce');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }
}
