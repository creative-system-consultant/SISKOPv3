<?php

namespace App\Models;

use App\Http\Traits\HasRules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Approval extends Model implements Auditable
{
    use HasRules;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.approvals";
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
                            'rule_email',
                        ];

    public function approval()
    {
        return $this->morphTo();
    }

    public function rolegroup()
    {
        return $this->belongsTo(CoopRoleGroup::class,'group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
