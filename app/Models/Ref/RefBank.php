<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefBank extends Model
{
    use HasFactory, SoftDeletes;

    protected $table   = 'ref.banks';
    protected $guarded = [];

}
