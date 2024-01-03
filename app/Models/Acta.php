<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acta extends Model
{
	public function operativo()
	{
		return $this->belongsTo(Operativo::class);
	}

	public function empresa()
	{
		return $this->belongsTo(Empresa::class);
	}

	public function inspector()
	{
		return $this->belongsTo(Inspector::class);
	}

	public function conductor()
	{
		return $this->belongsTo(Conductor::class);
	}

	public function vehiculo()
	{
		return $this->belongsTo(Vehiculo::class);
	}

	public function infraccion()
	{
		return $this->belongsTo(Infraccion::class);
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class);	
	}
    use HasFactory;
}
