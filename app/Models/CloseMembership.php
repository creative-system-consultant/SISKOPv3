<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CloseMembership extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'SISKOP.BERHENTI_ANGGOTA';
    protected $guarded = [];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo('app\Models\Customers', 'cust_id', 'id');
    }
}
