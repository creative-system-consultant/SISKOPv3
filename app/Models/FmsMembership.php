<?php

namespace App\Models;

use App\Models\Ref\RefMbrStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMembership extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MEMBERSHIP';
    protected $guarded = [];

    public function fmsAcctMaster()
    {
        return $this->hasMany(AccountMaster::class, 'mbr_no', 'mbr_no')
            ->where('client_id', $this->client_id);
    }

    public function fmsCustomer()
    {
        return $this->hasOne(Customer::class, 'id', 'cif_id')
            ->where('client_id', $this->client_id);
    }

    public function refMemStat()
    {
        return $this->hasOne(RefMbrStatus::class, 'mbr_status', 'mbr_status')
            ->whereColumn('client_id', 'client_id');
    }
}
