<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CustEmployer extends Model implements Auditable
{
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "CIF.cust_employer";
    protected $guarded = ['uuid'];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function address()
    {
        return $this->morphMany(Address::class,'addressable');
    }

}
