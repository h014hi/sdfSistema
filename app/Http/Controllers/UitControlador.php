<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uit;

class UitControlador extends Controller
{
    public function create(Request $request)
    {
        $nuevo_uit = new Uit;
        $nuevo_uit->anio = $request->input('anio');
        $nuevo_uit->valor = $request->input('valor');

        $nuevo_uit->save();
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        $uit_update = Uit::findOrFail($id);
        $uit_update->anio = $request->input('anio_edit');
        $uit_update->valor = $request->input('valor_edit');

        $uit_update->save();
        return redirect()->back();
    }
}
