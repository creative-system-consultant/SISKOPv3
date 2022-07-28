<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SpecialAid extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'SISKOP.special_aids';
    protected $guarded = [];
    protected $dates   = ['start_date', 'end_date','created_at','deleted_at','updated_at'];

    public function field()
    {
        return $this->morphMany(SpecialAidField::class,'fieldable');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }
}
