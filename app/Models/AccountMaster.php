<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountMaster extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "FMS.Account_Masters";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function customer()
    {
        return $this->hasMany(Customer::class,'id','cust_id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function product()
    {
        return $this->belongsTo(AccountProduct::class,'product_id','id');
    }

    public function position()
    {
        return $this->hasMany(AccountPosition::class,'account_no','account_no');
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function introducers()
    {
        return $this->morphMany(Introducer::class, 'introduce');
    }

    public function guarantors()
    {
        return $this->morphMany(Guarantor::class, 'guarantee');
    }

}
