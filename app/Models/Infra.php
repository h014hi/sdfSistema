<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infra extends Model
{
    use HasFactory;
    protected $table = 'infracciones';

    public function infraccionPadre()
    {
        return $this->belongsTo(Infraccions::class, 'infraccion_id');
    }
}
