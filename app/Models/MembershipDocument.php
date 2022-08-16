<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipField extends Model
{
    protected $table   = "SISKOP.MEMBERSHIP_DOCUMENT";
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
}
