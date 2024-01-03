<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Empresa;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function conductor($id)
    {
        $conductor = Conductor::where('dni', $id)->first();
        return $conductor;
    }

    public function placas($id)
    {
        $placa = Vehiculo::where('placa', $id)->first();
        return $placa;
    }


    public function empresas()
    {
        $placa = Empresa::all();
        return $placa;
    }
}
