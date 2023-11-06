<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserGroup extends Model implements Auditable
{
    use HasCoop;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.USER_GROUP';
    protected $guarded = [];
    protected $appends = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

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

    public function status()
    {
        if ($this->status = 1){ return 'ACTIVE'; } else { return 'INACTIVE'; };
    }
}


//make copy as new