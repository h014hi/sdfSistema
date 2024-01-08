<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infraccions extends Model
{
    use HasFactory;
    protected $table = 'infraccion';

    public function infraccionesHijas()
    {
        return $this->hasMany(Infra::class, 'infraccion_id');
    }
}
