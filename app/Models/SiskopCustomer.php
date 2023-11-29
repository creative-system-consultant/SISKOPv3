<?php

namespace App\Models;

use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SiskopCustomer extends Model implements Auditable
{
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.customers";
    protected $guarded = ['uuid'];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
    protected $appends = [
        'icno'
    ];

    public function family()
    {
        return $this->hasMany(SiskopFamily::class, 'cust_id');
    }

    public function specialAid()
    {
        return $this->hasOne(ApplySpecialAid::class, 'cust_id', 'id');
    }

    public function address()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'cust_id', 'id');
    }

    public function contribution()
    {
        return $this->hasOne(Contribution::class, 'cust_id', 'id');
    }

    public function field()
    {
        return $this->morphMany(CustCustomField::class, 'fieldable');
    }

    public function field_value($name)
    {
        return $this->field->where('name', $name)->first()?->value;
    }

    public function employer()
    {
        return $this->hasOne(CustEmployer::class, 'cust_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'icno', 'icno');
    }

    public function membership()
    {
        return $this->hasOne(ApplyMembership::class, 'cust_id');
    }

    public function Introducer()
    {
        return $this->morphMany(introducer::class, 'introduce');
    }

    public function getIcnoAttribute()
    {
        return $this->identity_no;
    }

    public function setIcnoAttribute($value)
    {
        return $this->identity_no = $value;
    }

    public function status()
    {
        if ($this->cust_status == 'Y') {
            return "ACTIVE";
        } else {
            return "NOT ACTIVE";
        }
    }
}
