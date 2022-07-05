<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialAid extends Model
{
    use SoftDeletes;

    protected $table   = 'SISKOP.special_aids';
    protected $guarded = [];
    protected $dates   = ['start_date', 'end_date'];

    public function field()
    {
        return $this->morphMany(SpecialAidField::class,'fieldable');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }
}
