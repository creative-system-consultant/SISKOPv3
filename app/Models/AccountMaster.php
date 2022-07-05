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
}
