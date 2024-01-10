<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ClientApproval extends Model implements Auditable
{
    use HasCoop;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.client_approval';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function approvals($product = NULL, $range = NULL)
    {
        if ($product != NULL && $range != NULL){
            return $this->hasMany(ClientApprovalRole::class,'approval_id')->where('product_id', $product)->where('product_range', $range);
        } else if ($product != NULL && $range == NULL){
            return $this->hasMany(ClientApprovalRole::class,'approval_id')->where('product_id', $product);
        } else return $this->hasMany(ClientApprovalRole::class,'approval_id');
    }

    public function getids()
    {
        return explode(',',$this->approvals()->select('role_id')->get()->implode('role_id',','));
    }
}
