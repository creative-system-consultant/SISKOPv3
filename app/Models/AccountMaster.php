<?php

namespace App\Models;

use App\Models\Ref\RefAccountStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountMaster extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "FMS.Account_Masters";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }

    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }

    public function product()
    {
        return $this->belongsTo(AccountProduct::class,'product_id','id');
    }

    public function position()
    {
        return $this->hasMany(AccountPosition::class,'account_no','account_no');
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function introducers()
    {
        return $this->morphMany(Introducer::class, 'introduce');
    }

    public function guarantors()
    {
        return $this->morphMany(Guarantor::class, 'guarantee');
    }

    public function approvals()
    {
        return $this->morphMany(Approval::class,'approval');
    }

    public function current_approval()
    {
        return $this->approvals()->where('order', $this->apply_step)->first();
    }

    public function current_approval_role()
    {
        return CoopRoleGroup::find($this->current_approval()->group_id);
    }

    public function status()
    {
        return $this->belongsTo(RefAccountStatus::class,'account_status');
    }

    public function make_approvals()
    {
        $CoopApprovalRoles = CoopApprovalRole::where([['coop_id', $this->coop_id],['product_id', $this->product_id],['approval_id', 1]])->orderBy('order')->get();

        $count = 1;
        foreach ($CoopApprovalRoles as $key => $value) {
            $approval = $this->approvals()->firstOrCreate(['order' => $count]);
            $approval->group_id = $value->role_id;
            $approval->rules    = $value->rules;
            $approval->user_id  = NULL;
            $approval->type     = NULL;
            $approval->note     = NULL;
            $approval->vote     = NULL;
            $approval->save();
            $count++;
        }

        return $CoopApprovalRoles;
    }

}
