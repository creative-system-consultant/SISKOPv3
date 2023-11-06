<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;

class Approval extends Model implements Auditable
{
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

    public function getRule($type, $def = 0)
    {
        return Arr::get(json_decode($this->rules,true),$type,$def) ?? '0';
    }

    public function setRule($type,$value)
    {
        $arr1 = json_decode($this->rules,true);
        $this->rules = json_encode(Arr::set($arr1,$type,$value));
    }

    /* 
        $this->role
        start
    */
    public function getRoleAttribute()
    {
        return $this->getRule('role',NULL);
    }

    public function setRoleAttribute($value)
    {
        return $this->setRule('role',$value);
    }
    /*    end    */


    /* 
        $this->rule_min
        start
    */
    public function getRuleMinAttribute()
    {
        return $this->getRule('min');
    }

    public function setRuleMinAttribute($value)
    {
        return $this->setRule('min',$value);
    }
    /*    end    */

    /* 
        $this->rule_max
        start
    */
    public function getRuleMaxAttribute()
    {
        return $this->getRule('max');
    }

    public function setRuleMaxAttribute($value)
    {
        return $this->setRule('max',$value);
    }
    /*    end    */

    /* 
        $this->rule_forward
        start
    */
    public function getRuleForwardAttribute()
    {
        return $this->getRule('forward',FALSE);
    }

    public function setRuleForwardAttribute($value)
    {
        return $this->setRule('forward',$value);
    }
    /*    end    */

    /* 
        $this->rule_vote
        start
    */
    public function getRuleVoteAttribute()
    {
        return $this->getRule('vote',FALSE);
    }

    public function setRuleVoteAttribute($value)
    {
        return $this->setRule('vote',$value);
    }
    /*    end    */

    /* 
        $this->rule_employee
        start
    */
    public function getRuleEmployeeAttribute()
    {
        return $this->getRule('employee',NULL);
    }

    public function setRuleEmployeeAttribute($value)
    {
        return $this->setRule('employee',$value);
    }
    /*    end    */

    /* 
        $this->rule_whatsapp
        start
    */
    public function getRuleWhatsappAttribute()
    {
        return $this->getRule('whatsapp',FALSE);
    }

    public function setRuleWhatsappAttribute($value)
    {
        return $this->setRule('whatsapp',$value);
    }
    /*    end    */

    /* 
        $this->rule_sms
        start
    */
    public function getRuleSmsAttribute()
    {
        return $this->getRule('sms',FALSE);
    }

    public function setRuleSmsAttribute($value)
    {
        return $this->setRule('sms',$value);
    }
    /*    end    */

    /* 
        $this->rule_email
        start
    */
    public function getRuleEmailAttribute()
    {
        return $this->getRule('email',FALSE);
    }

    public function setRuleEmailAttribute($value)
    {
        return $this->setRule('email',$value);
    }
    /*    end    */
}
