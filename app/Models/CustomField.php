<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $table = 'SISKOP.sys_custom_field';
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

    public function inputType()
    {
        switch ($this->type) {
            case 'string' : return 'text'; break;
            case 'date'   : return 'date'; break;
            default:        return 'text'; break;
        }
    }
}
