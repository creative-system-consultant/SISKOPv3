<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialAidField extends Model
{
    protected $table = 'SISKOP.sys_field_special_aid';
    protected $guarded = [];
    protected $appends = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function fieldable()
    {
        return $this->morphTo();
    }

    public function types()
    {
        return ['string', 'decimal','decimal4', 'date', 'datetime', 'bigint'];
    }
}
