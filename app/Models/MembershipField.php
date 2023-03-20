<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;

class MembershipField extends Model
{
    use HasCoop;

    protected $table   = "SISKOP.MEMBERSHIP_FIELD";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function membership()
    {
        return $this->belongsTo(Membership::class,'membership_id','id');
    }

    public function field()
    {
        return $this->belongsTo(FieldMaster::class,'field_id','id');
    }
}
