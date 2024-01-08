<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infra_Incum extends Model
{

    public function actas()
	{
		return $this->hasMany(Acta::class);
    }

    public function infraccion()
    {
        return $this->belongsTo(Infra::class, 'infra_id');
    }

    public function incumplimiento()
    {
        return $this->belongsTo(Incum::class, 'incum_id');
    }


    use HasFactory;
}
