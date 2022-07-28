<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $table   = 'siskop.notifications';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
