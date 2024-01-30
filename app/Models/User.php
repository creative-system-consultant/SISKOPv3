<?php

namespace App\Models;

use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasFiles;
    use HasRoles;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'FMS.users';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
        'identity_no'
    ];

    public function customer()
    {
        return $this->hasMany(Customer::class,'identity_no','icno');
    }

    public function coop_cust($id)
    {
        return $this->customer()->where('client_id', $id)->first();
    }

    public function user_roles()
    {
        return $this->hasMany(UserGroup::class,'user_id')->where('client_id', $this->client_id);
    }

    public function role_ids()
    {
        return explode(',',$this->user_roles()->select('grouping_id')->get()->implode('grouping_id',','));
    }

    public function user_client() {
        return $this->belongsToMany(Client::class, 'ref.user_has_clients', 'user_id');
    }

    public function getIdentityNoAttribute()
    {
        return $this->icno;
    }

    public function setIdentityNoAttribute($value)
    {
        return $this->icno = $value;
    }

    public function ismember($client_id = NULL)
    {
        $cust = Customer::where([['client_id', $client_id ?? $this->client_id],['identity_no', $this->icno]])->first();
        if ($cust == NULL){
            return FALSE;
        } else {
            return TRUE;
        }
    }
}