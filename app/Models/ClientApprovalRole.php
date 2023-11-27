<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ClientApprovalRole extends Model implements Auditable
{
    use HasCoop;
    use HasRules;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.client_approval_role';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
    protected $appends = [
                            'role',
                            'rule_min',
                            'rule_max',
                            'rule_vote',
                            'rule_vote_type',
                            'rule_forward',
                            'rule_employee',
                            'rule_whatsapp',
                            'rule_sms',
                            'rule_email'
                        ];

    public function rolegroup()
    {
        return $this->belongsTo(ClientRoleGroup::class,'role_id');
    }

    public function sys_role()
    {
        return $this->hasOneThrough(UserRole::class,ClientRoleGroup::class,'id','id','role_id','role_id');
    }
}
