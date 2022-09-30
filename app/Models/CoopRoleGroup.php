<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CoopRoleGroup extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.COOP_ROLE_GROUP';
    protected $guarded = [];
    protected $appends = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function users()
    {
        return $this->morphMany(UserGroup::class,'grouping');
    }

    public function getids()
    {
        return explode(',',$this->users()->select('user_id')->get()->implode('user_id',','));
    }

    public function status()
    {
        if ($this->status == 1){ return 'ACTIVE'; } else { return 'INACTIVE'; };
    }
}
