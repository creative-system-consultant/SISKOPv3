<?php

namespace App\Http\Traits;

use App\Models\Coop;

trait HasCoop
{
    public function coop()
    {
        return $this->belongsTo(Coop::class,'coop_id');
    }
}
