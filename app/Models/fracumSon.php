<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FracumSon extends Model
{
    use HasFactory;
    protected $table = 'fracumson';

    public function fFather()
    {
        return $this->belongsTo(FracumFather::class,'fracumfather_id');
    }
    public function fFracumF()
    {
        return $this->belongsTo(Fracum::class);
    }
}
