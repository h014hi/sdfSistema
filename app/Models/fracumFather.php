<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FracumFather extends Model
{
    use HasFactory;
    protected $table = 'fracumfather';

    public function fSons()
    {
        return $this->hasMany(FracumSon::class,'fracumfather_id');
    }
    public function fFracumS()
    {
        return $this->belongsTo(Fracum::class);
    }

}
