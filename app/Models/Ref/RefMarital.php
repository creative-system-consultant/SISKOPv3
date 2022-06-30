<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefMarital extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_marital';
    protected $guarded = [];

}
