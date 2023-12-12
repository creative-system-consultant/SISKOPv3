<?php

namespace App\Models;

use App\Models\Ref\RefClientType;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Client extends Model implements Auditable
{
    use HasFiles;
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "ref.CLIENT";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class,'client_id');
    }

    public function address()
    {
        return $this->morphMany(Address::class,'addressable');
    }

    public function types()
    {
        return RefClientType::where('status','1')->get();
    }

    public function type()
    {
        return $this->hasOne(RefClientType::class,'id','type_id');
    }

    public function status()
    {
        if ($this->status == 1) { return 'ACTIVE'; }
        else { return 'INACTIVE'; }
    }

    public function fields()
    {
        return $this->morphMany(CustomField::class,'fieldable');
    }

    public function rules()
    {
        return $this->morphMany(ClientRules::class, 'ruleable');
    }

    public function admins()
    {
        return $this->hasMany(ClientAdmin::class,'client_id');
    }
    public function getids()
    {
        return explode(',',$this->admins()->select('user_id')->get()->implode('user_id',','));
    }
}
