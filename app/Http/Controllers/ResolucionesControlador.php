<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resolucion;
use App\Models\Acta;

class ResolucionesControlador extends Controller
{
    public function index()
    {
        $resoluciones = Resolucion::join('actas', 'resolucions.acta_id', '=', 'actas.id')
            ->select('resolucions.*', 'actas.numero as acta_numero')
            ->orderBy('actas.numero', 'asc')
            ->paginate(5);

        $actas = Acta::all();

        return view('resoluciones', ['resoluciones' => $resoluciones, 'actas' => $actas]);
    }

    public function create(Request $request)
    {
        $nueva_resolucion = new Resolucion;

        $cambia = Acta::findOrFail($request->input('acta'));
        $cambia->estado = "CONRDR";
        $cambia->save();

        $nueva_resolucion->n_resolucion = $request->input('n_resolucion');
        $nueva_resolucion->fecha= $request->input('fecha');
        $nueva_resolucion->detalle = $request->input('detalle');
        $nueva_resolucion->acta_id = $request->input('acta');
        $nueva_resolucion->save();
        return redirect()->back();
    }

    public function update(Request $request, string $id)
    {
        // Obtener el operativo a actualizar
        $nueva_resolucion = Resolucion::findOrFail($id);
        $cambia = Acta::findOrFail($request->input('acta'));
        $cambia->estado = "CONRDR";
        $cambia->save();

        $nueva_resolucion->n_resolucion= $request->input('n_resolucion');
        $nueva_resolucion->fecha= $request->input('fecha');
        $nueva_resolucion->detalle = $request->input('detalle');
        $nueva_resolucion->acta_id = $request->input('acta');
        $nueva_resolucion->save();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $resolucion = Resolucion::findOrFail($id);
        $resolucion->delete();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
