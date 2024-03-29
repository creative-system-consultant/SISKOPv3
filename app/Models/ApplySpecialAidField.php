<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplySpecialAidField extends Model
{
    protected $table    = 'SISKOP.apply_special_aid_field';
    protected $guarded  = [];
    protected $appends  = [ 'value', ];
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

    public function getValueAttribute()
    {
        if ($this->type == 'string'){   return $this->string; }
        if ($this->type == 'decimal'){  return $this->decimal; }
        if ($this->type == 'decimal4'){ return $this->decimal4; }
        if ($this->type == 'date'){     return $this->date; }
        if ($this->type == 'datetime'){ return $this->datetime; }
        if ($this->type == 'bigint'){   return $this->bigint; }
        return '';
    }

    public function setValueAttribute($value)
    {
        if ($this->type == 'string'){   $this->string   = $value; }
        if ($this->type == 'decimal'){  $this->decimal  = $value; }
        if ($this->type == 'decimal4'){ $this->decimal4 = $value; }
        if ($this->type == 'date'){     $this->date     = $value; }
        if ($this->type == 'datetime'){ $this->datetime = $value; }
        if ($this->type == 'bigint'){   $this->bigint   = $value; }
    }


}
