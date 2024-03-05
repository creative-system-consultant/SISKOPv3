<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuarantorList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = "FMS.GUARANTOR_LIST";
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function fmsMembership()
    {
        return $this->hasOne(FmsMembership::class, 'mbr_no', 'guarantor_mbr_no')
            ->where('client_id', $this->client_id);
    }
}
