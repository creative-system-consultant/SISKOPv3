<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplySpecialAid extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.apply_special_aid';
    
    protected $guarded = [];
    protected $dates   = ['start_date', 'end_date'];

    public function field()
    {
        return $this->morphMany(ApplySpecialAidField::class,'fieldable');
    }
}
