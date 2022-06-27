<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefReligion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_religions';
    protected $fillable = [
        'id',
        'description', 
        'code', 
        'status'
    ];

}
