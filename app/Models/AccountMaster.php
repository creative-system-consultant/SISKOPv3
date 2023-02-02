<?php

namespace App\Models;

use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use App\Models\Ref\RefAccountStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class AccountMaster extends Model implements Auditable
{
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "FMS.Account_Masters";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

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

    public function remove_approvals()
    {
        $approval = $this->approvals;
        foreach ($approval as $key => $value) {
            $value->delete();
        }
    }

    public function clear_approvals($order = NULL)
    {
        if ($order != NULL){
            $approval = $this->approvals()->where('order', $order)->get();
        } else {
            $approval = $this->approvals;
        }

        foreach ($approval as $key => $value) {
            if ($value->role_id == 1 || $value->role_id == 2){ 
                $value->user_id = NULL; 
                $value->type    = NULL;
            }
            $value->note = NULL;
            $value->vote = NULL;
        }
    }

    public function make_approvals()
    {
        $CoopApproval = CoopApproval::where([['approval_type', 'financing'],['coop_id',$this->coop_id]])->first();
        if ($CoopApproval != NULL){
            $CoopApprovalRoles = CoopApprovalRole::where([['coop_id', $this->coop_id],['product_id', $this->product_id],['approval_id', $CoopApproval->id]])->orderBy('order')->get();
        } else {
            return NULL;
        }

        $count = 1;
        foreach ($CoopApprovalRoles as $key => $value) {

            if ($value->sys_role->name == 'APPROVER' || $value->sys_role->name == 'COMMITTEE'){
                foreach ($value->rolegroup->users as $key1 => $value1){
                    $approval = $this->approvals()->firstOrCreate(['order' => $count,'type' => 'vote'.$key1+1]);
                    $approval->group_id = $value->role_id;
                    $approval->rules    = $value->rules;
                    $approval->user_id  = $value1->user_id;
                    $approval->role_id  = $value->sys_role->id;
                    $approval->type     = 'vote'.$key1+1;
                    $approval->note     = NULL;
                    $approval->vote     = NULL;
                    $approval->save();
                }
            } else {

                $approval = $this->approvals()->firstOrCreate(['order' => $count]);
                $approval->group_id = $value->role_id;
                $approval->rules    = $value->rules;
                $approval->user_id  = NULL;
                $approval->role_id  = $value->sys_role->id;
                $approval->type     = NULL;
                $approval->note     = NULL;
                $approval->vote     = NULL;
                $approval->save();

                $count++;
            }
        }

        return '';
    }

}
