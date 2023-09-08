<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplySpecialAid extends Model
{
    use HasCoop;
    use HasCustomer;
    use SoftDeletes;

    protected $table = 'SISKOP.apply_special_aid';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function field()
    {
        return $this->morphMany(ApplySpecialAidField::class,'fieldable');
    }

    public function notification()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }
}
