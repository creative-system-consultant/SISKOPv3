<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplySpecialAid extends Model
{
    use HasCustomer;
    use SoftDeletes;

    protected $table = 'SISKOP.apply_special_aid';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function field()
    {
        return $this->morphMany(ApplySpecialAidField::class,'fieldable');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function notification()
    {
        return $this->morphMany(Notification::class,'notifiable');
    }
}
