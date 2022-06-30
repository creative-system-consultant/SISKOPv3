<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CoopCust extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Coop_cust";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    //
}
