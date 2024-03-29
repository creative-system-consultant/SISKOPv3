<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Membership extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Membership";
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function fields()
    {
        return $this->hasMany(MembershipField::class,'membership_id','id');
    }

    public function field_status($id)
    {
        return $this->fields->where('field_id',$id)->first()?->status;
    }

    public function documents()
    {
        return $this->hasMany(MembershipDocument::class,'membership_id','id');
    }

    public function document_status($code)
    {
        return $this->documents->where('type',$code)->first()?->status;
    }


}
