<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contribution extends Model implements Auditable
{
    use SoftDeletes;
    use HasCustomer;
    use HasFiles;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.contribution';
    protected $guarded = [];
    protected $dates   = ['start_apply','online_date','cdm_date','cheque_date','created_at','deleted_at','updated_at'];

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }
}
