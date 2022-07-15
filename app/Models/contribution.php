<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class contribution extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.contribution';
    protected $guarded = [];
    protected $dates   = ['start_apply','online_date','cdm_date','cheque_date','created_at','deleted_at','updated_at'];

    public function customer()
    {
        return $this->hasMany(Customer::class,'id','cust_id');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }
}
