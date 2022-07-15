<?php

namespace App\Models;

use App\Models\Ref\RefCoopType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Coop extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table   = "SISKOP.Coop";
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];

    protected static function boot(){
        parent::boot();

        static::creating(function ($model){
            $model->created_by  = Auth()->user()->name ?? 'SYSTEM';
        });
        static::updating(function ($model){
            $model->updated_by  = Auth()->user()->name ?? 'SYSTEM';
        });
        static::deleting(function ($model){
            $model->deleted_by  = Auth()->user()->name ?? 'SYSTEM';
        });
    }

    public function address()
    {
        return $this->morphMany(Address::class,'addressable');
    }

    public function types()
    {
        return RefCoopType::where('status','1')->get();
    }

    public function type()
    {
        return $this->hasOne(RefCoopType::class,'id','type_id');
    }

    public function files()
    {
        return $this->morphMany(FileMaster::class,'fileable');
    }

    public function status()
    {
        if ($this->status == 1) { return 'ACTIVE'; } 
        else { return 'INACTIVE'; } 
    }
}
