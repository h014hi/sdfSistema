<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    public function actas()
    {
        return $this->hasMany(Acta::class);
    }
    use HasFactory;
}
