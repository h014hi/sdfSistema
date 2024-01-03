<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfraccionControlador extends Controller
{
    /*public function showInfraccion($id_infra)
    {
        return view('infraccion', ['id_infra' => $id_infra]);
    }*/

    public function showInfraccion($data_infrac)
    {
        $infrac = json_decode(decrypt($data_infrac));
        return view('infraccion', compact('infrac'));
    }
}
