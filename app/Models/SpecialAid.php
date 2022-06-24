<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialAid extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'SISKOP.special_aids';
    
    protected $guarded = [];

    public function field()
    {
        return $this->morphMany(SpecialAidField::class,'fieldable');
    }
}
