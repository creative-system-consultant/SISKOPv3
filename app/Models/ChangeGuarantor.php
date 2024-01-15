<?php

namespace App\Models;

use App\Http\Traits\HasApprovals;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeGuarantor extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasApprovals;
    protected $table = 'SISKOP.CHANGE_GUARANTOR';
    protected $guarded = [];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cif_id', 'id');
    }

    public function account_application()
    {
        return $this->belongsTo(AccountApplication::class, 'account_no', 'FMS_account_no');
    }

    public function current_approval()
    {
        return $this->approvals()->where('order', $this->step)->first();
    }

    public function clear_approvals($order = NULL)
    {
        if ($order != NULL) {
            $approval = $this->approvals()->where('order', $order)->get();
        } else {
            $approval = $this->approvals;
        }

        foreach ($approval as $key => $value) {
            if ($value->role_id == 1 || $value->role_id == 2) {
                $value->user_id = NULL;
                $value->type    = NULL;
            }
            $value->note = NULL;
            $value->vote = NULL;
        }
    }

    public function make_approvals($type = 'ChangeGuarantor')
    {
        $ClientApproval = ClientApproval::where([['approval_type', $type], ['client_id', $this->client_id]])->first();
        if ($ClientApproval != NULL) {
            $ClientApprovalRoles = ClientApprovalRole::where([['client_id', $this->client_id], ['approval_id', $ClientApproval->id]])->orderBy('order')->get();
        } else {
            return NULL;
        }

        $count = 1;
        foreach ($ClientApprovalRoles as $key => $value) {

            if ($value->sys_role->name == 'APPROVER' || $value->sys_role->name == 'COMMITTEE') {
                foreach ($value->rolegroup->users as $key1 => $value1) {
                    $approval = $this->approvals()->firstOrCreate(['order' => $count, 'type' => 'vote' . $key1 + 1]);
                    $approval->group_id = $value->role_id;
                    $approval->rules    = $value->rules;
                    $approval->user_id  = $value1->user_id;
                    $approval->role_id  = $value->sys_role->id;
                    $approval->type     = 'vote' . $key1 + 1;
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
            }
            $count++;
        }

        return '';
    }

    public function approval_vote_id($type = 3)
    {
        return explode(',', $this->approvals()->where([['order', $this->step], ['role_id', $type]])->select('user_id')->get()->implode('user_id', ','));
    }

    public function approval_unvoted_id($type = 3)
    {
        return explode(',', $this->approvals()->where([['order', $this->step], ['vote', NULL], ['role_id', $type]])->select('user_id')->get()->implode('user_id', ','));
    }

    public function approval_vote_yes()
    {
        return $this->approvals()->where([['order', $this->step], ['vote', 'lulus']])->count();
    }

    public function approval_vote_no()
    {
        return $this->approvals()->where([['order', $this->step], ['vote', 'gagal']])->count();
    }
}
