<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Notification extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.notification';
    protected $guarded = [];
    protected $dates   = ['start_apply','online_date','cdm_date','cheque_date','created_at','deleted_at','updated_at'];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
