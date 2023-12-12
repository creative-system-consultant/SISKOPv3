<?php

namespace App\Http\Traits;

use Illuminate\Support\Arr;

trait HasRules
{

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
        $this->rule_vote_type
        start
    */
    public function getRuleVoteTypeAttribute()
    {
        return $this->getRule('vote_type','majority');
    }

    public function setRuleVoteTypeAttribute($value)
    {
        return $this->setRule('vote_type',$value);
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
