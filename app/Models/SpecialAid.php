<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SpecialAid extends Model implements Auditable
{
    use HasCoop;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'SISKOP.special_aids';
    protected $guarded = [];
    protected $dates   = ['start_date', 'end_date','created_at','deleted_at','updated_at'];
    protected $casts   = [
        'start_date'    => 'datetime',
        'end_date'      => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function field()
    {
        return $this->morphMany(SpecialAidField::class,'fieldable');
    }
}
