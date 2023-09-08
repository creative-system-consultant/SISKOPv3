<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;

class MembershipField extends Model
{
    use HasCoop;

    protected $table   = "SISKOP.MEMBERSHIP_FIELD";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class,'membership_id','id');
    }

    public function field()
    {
        return $this->belongsTo(FieldMaster::class,'field_id','id');
    }
}
