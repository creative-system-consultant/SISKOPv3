<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class share extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.shares';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function customer()
    {
        return $this->hasMany(Customer::class,'id','cust_id');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }
}
