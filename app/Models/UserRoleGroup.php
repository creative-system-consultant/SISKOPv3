<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserRoleGroup extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.SYS_ROLE_GROUP';
    protected $guarded = [];
    protected $appends = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    //
}
