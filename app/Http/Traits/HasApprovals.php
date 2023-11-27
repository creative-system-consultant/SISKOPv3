<?php

namespace App\Http\Traits;

use App\Models\Approval;
use App\Models\ClientRoleGroup;

trait HasApprovals
{
    public function approvals()
    {
        return $this->morphMany(Approval::class,'approval');
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

        return true;
    }
}
