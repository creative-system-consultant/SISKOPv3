<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    protected $connection = 'sqlsrv_fms';
    protected $table   = 'ref.USER_HAS_CLIENTS';
    protected $guarded = [];
    protected $appends = [];

    //
}
