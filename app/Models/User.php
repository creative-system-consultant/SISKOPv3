<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'SISKOP.users';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url','coop_id',
    ];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function getCoopIdAttribute()
    {
        return '1';
    }

    public function customer()
    {
        return $this->hasMany(Customer::class,'icno','icno');
    }

    public function coop_cust($id)
    {
        return $this->customer()->where('coop_id', $id)->first();
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function roles()
    {
        return $this->hasMany(UserGroup::class,'user_id')->where('coop_id', $this->coop_id);
    }

    public function role_ids()
    {
        return explode(',',$this->roles()->select('grouping_id')->get()->implode('grouping_id',','));
    }
}