<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMembership extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MEMBERSHIP';
    protected $guarded = [];
}
