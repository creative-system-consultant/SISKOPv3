<?php

namespace App\Models;

use App\Models\Ref\RefCoopType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CoopRules extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Coop_Rules";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function ruleable()
    {
        return $this->morphTo();
    }
}
