<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CustFamily extends Model implements Auditable
{
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "CIF.cust_family";
    protected $guarded = ['uuid'];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function data()
    {
        return $this->belongsTo(Customer::class,'family_id', 'id');
    }

    public function cust()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
