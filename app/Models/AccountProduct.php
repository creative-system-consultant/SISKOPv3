<?php

namespace App\Models;

use App\Http\Traits\HasFiles;
use App\Models\Ref\RefProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountProduct extends Model implements Auditable
{
    use SoftDeletes;
    use HasFiles;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Account_Products";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function documents()
    {
        return $this->hasMany(AccountProductDocument::class, 'product_id', 'id');
    }

    public function document_status($code)
    {
        return $this->documents->where('type',$code)->first()?->status;
    }

    public function type()
    {
        return $this->belongsTo(RefProductType::class, 'product_type');
    }
}
