<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fracum extends Model
{
    use HasFactory;
    protected $table = 'fracum';

    public function fCods()
    {
        return $this->hasMany(FracumFather::class, 'id');
    }

    public function fSubCods()
    {
        return $this->hasMany(FracumSon::class, 'id');
    }

    public function actas()
    {
        return $this->belongsToMany(Acta::class);
    }
}
