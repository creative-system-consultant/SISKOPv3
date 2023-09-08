<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasCustomer;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Share extends Model implements Auditable
{
    use HasCoop;
    use HasCustomer;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = 'siskop.shares';
    protected $guarded = [];
    protected $casts   = [
        'online_date'   => 'datetime',
        'cdm_date'      => 'datetime',
        'cheque_date'   => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function buyer()
    {
        return $this->belongsTo(Customer::class, 'exc_cust_id', 'id');
    }

    public function approvals()
    {
        return $this->morphMany(Approval::class,'approval');
    }

    public function current_approval()
    {
        return $this->approvals()->where('order', $this->step)->first();
    }

    public function current_approval_role()
    {
        return CoopRoleGroup::find($this->current_approval()->group_id);
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
        $CoopApproval = CoopApproval::where([['approval_type', 'Share'],['coop_id',$this->coop_id]])->first();
        if ($CoopApproval != NULL){
            $CoopApprovalRoles = CoopApprovalRole::where([['coop_id', $this->coop_id],['approval_id', $CoopApproval->id]])->orderBy('order')->get();
        } else {
            return NULL;
        }

        $count = 1;
        foreach ($CoopApprovalRoles as $key => $value) {

            if ($value->sys_role->name == 'APPROVER' || $value->sys_role->name == 'COMMITTEE'){
                $lastuser = '';
                $cnt = 1;
                foreach ($value->rolegroup->users()->orderby('user_id')->get() as $key1 => $value1){
                    if($lastuser == $value1->user_id){ continue; }
                    $approval = $this->approvals()->withTrashed()->firstOrCreate(['order' => $count,'type' => 'vote'.$cnt]);
                    $approval->group_id = $value->role_id;
                    $approval->rules    = $value->rules;
                    $approval->user_id  = $value1->user_id;
                    $approval->type     = 'vote'.$cnt;
                    $approval->role_id  = $value->sys_role->id;
                    $approval->note     = NULL;
                    $approval->vote     = NULL;
                    $approval->deleted_at = NULL;
                    $approval->save();
                    $lastuser = $value1->user_id;
                    $cnt++;
                }
            } else {

                $approval = $this->approvals()->withTrashed()->firstOrCreate(['order' => $count]);
                $approval->group_id = $value->role_id;
                $approval->rules    = $value->rules;
                $approval->user_id  = NULL;
                $approval->role_id  = $value->sys_role->id;
                $approval->type     = NULL;
                $approval->note     = NULL;
                $approval->vote     = NULL;
                $approval->deleted_at = NULL;
                $approval->save();

                $count++;
            }
        }

        return '';
    }

    public function approval_vote_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }

    public function approval_unvoted_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['vote', NULL],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }
}
