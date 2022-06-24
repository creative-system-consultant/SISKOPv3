<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref_educations';
    protected $primaryKey = 'id';

    protected $fillable = ['description', 'code', 'status'];
}
