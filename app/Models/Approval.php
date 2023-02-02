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
    protected $dates   = ['created_at','deleted_at','updated_at'];
    protected $appends = ['rule_min','rule_max','rule_employee'];

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
}
