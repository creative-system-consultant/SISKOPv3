<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipField extends Model
{
    use SoftDeletes;

    protected $table   = "SISKOP.MEMBERSHIP_FIELD";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function Coop()
    {
        return $this->belongsTo(Coop::class,'coop_id','id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class,'membership_id','id');
    }

    public function field()
    {
        return $this->belongsTo(FieldMaster::class,'field_id','id');
    }
}
