<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationAdmin extends Model
{
    use SoftDeletes;

    protected $table   = "SISKOP.sys_notification";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function notifiable()
    {
        return $this->morphTo('notification');
    }

    public function status()
    {
        if ($this->status == 1) { return 'ACTIVE'; }
        else { return 'INACTIVE'; }
    }
}
