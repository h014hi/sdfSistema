<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incumplimiento extends Model
{
    use HasFactory;
    protected $table = 'incumplimiento';

    public function incumplimientosHijas()
    {
        return $this->hasMany(Incum::class, 'incumplimiento_id');
    }
}
