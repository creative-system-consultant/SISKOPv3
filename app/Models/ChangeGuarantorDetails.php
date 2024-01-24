<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeGuarantorDetails extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'SISKOP.CHANGE_GUARANTOR_DETAILS';
    protected $guarded = [];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function changeGuarantor()
    {
        return $this->belongsTo(ChangeGuarantor::class, 'apply_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cif_id', 'id');
    }
}
