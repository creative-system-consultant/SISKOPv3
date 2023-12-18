<?php

namespace App\Models;

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
}
