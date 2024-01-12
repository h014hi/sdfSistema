<?php

namespace App\Http\Controllers;

use App\Models\FracumSon;
use Illuminate\Http\Request;

class InfraccionControlador extends Controller
{
    /*public function showInfraccion($id_infra)
    {
        return view('infraccion', ['id_infra' => $id_infra]);
    }*/

    public function showInfraccion($tipo,$id)
    {
        $fracum = FracumSon::find($id);
        return view('infraccion', ['tipo' => $tipo, 'fracum' => $fracum]);
    }
}
