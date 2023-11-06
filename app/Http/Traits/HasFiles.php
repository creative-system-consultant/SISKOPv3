<?php

namespace App\Http\Traits;

use App\Models\FileMaster;

trait HasFiles
{
    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }
}
