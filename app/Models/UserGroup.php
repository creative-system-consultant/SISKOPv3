<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserGroup extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.USER_GROUP';
    protected $guarded = [];
    protected $appends = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function grouping()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNameAttribute()
    {
        return $this->user->name;
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function status()
    {
        if ($this->status = 1){ return 'ACTIVE'; } else { return 'INACTIVE'; };
    }
}


//make copy as new