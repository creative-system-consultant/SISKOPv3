<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SpecialAidField extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.sys_field_special_aid';
    protected $guarded = [];
    protected $appends = [];

    public function fieldable()
    {
        return $this->morphTo();
    }

    public function types()
    {
        return ['string', 'decimal','decimal4', 'date', 'datetime', 'bigint'];
    }
}
