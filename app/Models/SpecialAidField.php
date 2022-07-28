<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialAidField extends Model
{
    protected $table = 'SISKOP.sys_field_special_aid';
    protected $guarded = [];
    protected $appends = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function fieldable()
    {
        return $this->morphTo();
    }

    public function types()
    {
        return ['string', 'decimal','decimal4', 'date', 'datetime', 'bigint'];
    }
}
