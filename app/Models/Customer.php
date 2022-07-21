<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "CIF.customers";
    protected $guarded = ['uuid'];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function getCoopIdAttribute()
    {
        return '1';
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function family()
    {
        return $this->hasMany(CustFamily::class,'id','family_id');
    }
    
    public function specialAid()
    {
        return $this->hasOne(ApplySpecialAid::class,'cust_id','id');
    }

    public function address()
    {
        return $this->morphMany(Address::class,'addressable');
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'cust_id', 'id');
    }

    public function contribution()
    {
        return $this->hasOne(Contribution::class,'cust_id','id');
    }

    public function field()
    {
        return $this->morphMany(CustCustomField::class,'fieldable');
    }

    public function field_value($name)
    {
        return $this->field->where('name', $name)->first()?->value;
    }

}
