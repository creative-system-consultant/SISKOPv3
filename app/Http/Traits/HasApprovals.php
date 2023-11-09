<?php

namespace App\Http\Traits;

use App\Models\Approval;
use App\Models\CoopRoleGroup;

trait HasApprovals
{
    public function approvals()
    {
        return $this->morphMany(Approval::class,'approval');
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

        return true;
    }
}
