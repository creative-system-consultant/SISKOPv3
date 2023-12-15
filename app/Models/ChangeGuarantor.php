<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeGuarantor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'SISKOP.TUKAR_PENJAMIN';
    protected $guarded = [];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo('app\Models\Customers', 'cust_id', 'id');
    }

    public function account_application()
    {
        return $this->belongsTo('app\Models\AccountApplication', 'account_no', 'FMS_account_no');
    }
}
