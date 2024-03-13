<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SiskopFamily extends Model implements Auditable
{
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.families";
    protected $guarded = ['uuid'];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function cust()
    {
        return $this->belongsTo(SiskopCustomer::class,'cif_id','id');
    }

    public function address()
    {
        return $this->morphMany(SiskopAddress::class, 'addressable');
    }

    public function relation() {
        return $this->belongsTo(Ref\RefRelationship::class,'relation_id', 'code');
    }

    public function relationship() {
        return $this->belongsTo(Ref\RefRelationship::class,'relation_id', 'code');
    }

    public function race() {
        return $this->belongsTo(Ref\RefRace::class,'race_id', 'code');
    }

    public function religion() {
        return $this->belongsTo(Ref\RefReligion::class,'religion_id', 'code');
    }
}
