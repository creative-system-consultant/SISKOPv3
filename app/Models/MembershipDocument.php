<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Models\Ref\RefMembershipDocument;
use Illuminate\Database\Eloquent\Model;

class MembershipDocument extends Model
{
    use HasCoop;

    protected $table   = "SISKOP.MEMBERSHIP_DOCUMENT";
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

    public function document()
    {
        return $this->belongsTo(RefMembershipDocument::class,'type','code');
    }
}
