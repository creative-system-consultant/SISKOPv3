<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountProduct extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Account_Products";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function documents()
    {
        return $this->hasMany(AccountProductDocument::class, 'product_id', 'id');
    }

    public function document_status($code)
    {
        return $this->documents->where('type',$code)->first()?->status;
    }
    
}
