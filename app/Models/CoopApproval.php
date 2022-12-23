<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CoopApproval extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.coop_approval';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function approvals($product = NULL)
    {
        if ($product != NULL){
            return $this->hasMany(CoopApprovalRole::class,'approval_id')->where('product_id', $product);
        } else return $this->hasMany(CoopApprovalRole::class,'approval_id');
    }

    public function getids()
    {
        return explode(',',$this->approvals()->select('role_id')->get()->implode('role_id',','));
    }
}
