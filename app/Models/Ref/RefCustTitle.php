<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefCustTitle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ref.cust_titles';
    protected $primaryKey = 'id';

    protected $fillable = ['description', 'code', 'status'];
}
