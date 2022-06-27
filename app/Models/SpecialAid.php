<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialAid extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.special_aids';
    
    protected $guarded = [];
    protected $dates   = ['start_date', 'end_date'];

    public function field()
    {
        return $this->morphMany(SpecialAidField::class,'fieldable');
    }
}
