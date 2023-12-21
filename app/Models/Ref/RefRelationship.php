<?php

namespace App\Models\Ref;

use App\Models\SiskopCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefRelationship extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.relations';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public static function GenderSpecificList($genderId, $client_id)
    {
        if ($genderId == 'M') {
            return self::whereNotIn('description', ['HUSBAND'])
                ->where('client_id', $client_id)
                ->where('status', 1)
                ->get();
        } elseif ($genderId == 'F') {
            return self::whereNotIn('description', ['WIFE'])
                ->where('client_id', $client_id)
                ->where('status', 1)
                ->get();
        }
    }
}
