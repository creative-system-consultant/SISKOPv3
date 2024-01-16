<?php

namespace App\Models;

use App\Http\Traits\HasCoop;
use App\Http\Traits\HasFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ApplyMembership extends Model implements Auditable
{
    use HasCoop;
    use HasFiles;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.APPLY_MEMBERSHIP";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function client() {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function customer()
    {
        return $this->belongsTo(SiskopCustomer::class,'cust_id','id');
    }

    public function introducers()
    {
        return $this->morphMany(introducer::class,'introduce');
    }

    function sharetype() {
        if ($this->share_pmt_mode_flag == 1){ return 'LUMP SUM'; } else { return 'INSTALLMENT'; }
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
        return ClientRoleGroup::find($this->current_approval()->group_id);
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
        $ClientApproval = ClientApproval::where([['approval_type', 'Membership'],['client_id',$this->client_id]])->first();
        if ($ClientApproval != NULL){
            $ClientApprovalRoles = ClientApprovalRole::where([['client_id', $this->client_id],['approval_id', $ClientApproval->id]])->orderBy('order')->get();
        } else {
            return NULL;
        }

        $count = 1;
        foreach ($ClientApprovalRoles as $key => $value) {

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
                $count++;
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

    public function approval_vote_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }

    public function approval_unvoted_id($type = 3)
    {
        return explode(',',$this->approvals()->where([['order', $this->step],['vote', NULL],['role_id',$type]])->select('user_id')->get()->implode('user_id',','));
    }

    public function approval_vote_yes() {
        return $this->approvals()->where([['order', $this->step],['vote', 'lulus']])->count();
    }

    public function approval_vote_no() {
        return $this->approvals()->where([['order', $this->step],['vote', 'gagal']])->count();
    }
}
