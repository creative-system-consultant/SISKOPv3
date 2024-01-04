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

    protected $table   = "CIF.families";
    protected $guarded = ['uuid'];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function data()
    {
        return $this->belongsTo(Customer::class,'family_id', 'id');
    }

    public function cust()
    {
        return $this->belongsTo(Customer::class,'cif_id','id');
    }

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
