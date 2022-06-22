<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialAid extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.special_aids';
    
    public $fillable = ['name', 'apply_amt_enable', 'default_apply_amt', 'coop_id'];
}
