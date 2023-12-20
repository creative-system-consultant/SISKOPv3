<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMbrStatus extends Model
{
    use HasFactory;

    protected $table   = 'REF.MEMBER_STATUS';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
