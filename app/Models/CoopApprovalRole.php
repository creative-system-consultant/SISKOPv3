<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;

class CoopApprovalRole extends Model implements Auditable
{
    use HasCoop;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.coop_approval_role';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
    protected $appends = ['rule_min','rule_max','rule_employee'];

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function rolegroup()
    {
        return $this->belongsTo(CoopRoleGroup::class,'role_id');
    }

    public function getRule($type, $def = 0)
    {
        return Arr::get(json_decode($this->rules,true),$type,$def) ?? '0';
    }

    public function sys_role()
    {
        return $this->hasOneThrough(UserRole::class,CoopRoleGroup::class,'id','id','role_id','role_id');
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
