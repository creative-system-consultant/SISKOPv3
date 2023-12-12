<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Models\Ref\RefCoopType;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ClientAdmin extends Model implements Auditable
{
    use HasCoop;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Client_admin";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function status()
    {
        if ($this->status == 1) { return 'ACTIVE'; }
        else { return 'INACTIVE'; }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
