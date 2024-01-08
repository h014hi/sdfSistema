<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incum extends Model
{
    use HasFactory;
    protected $table = 'incumplimientos';

    public function IncumplimientoPadre()
    {
        return $this->belongsTo(Incumplimiento::class, 'incumplimiento_id');
    }
}
