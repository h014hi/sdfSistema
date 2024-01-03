<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pago;
use App\Models\Acta;

class PagosControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos_realizados = Pago::join('actas', 'pagos.acta_id', '=', 'actas.id')
            ->select('pagos.*', 'actas.numero as acta_numero')
            ->orderBy('actas.numero', 'asc')
            ->paginate(5);

        $actas = Acta::all();

        return view('pagos', ['pagos' => $pagos_realizados, 'actas' => $actas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $nuevo_pago = new Pago;
        $nuevo_pago->tipo = $request->input('inputGroupSelect01');


        $cambia = Acta::findOrFail($request->input('acta'));

        if($request->input('inputGroupSelect01') == "INFRACCION" || $request->input('inputGroupSelect01') == "SANCION")
        {
            $cambia->estado = "ARCHIVADO";
            $cambia->save();
        }
        else if($request->input('inputGroupSelect01') == "RDR"){
            $cambia->estado = "ARCHIVADO";
            $cambia->save();
        }
        else
        {
            $cambia = Acta::findOrFail($request->input('acta'));
            $cambia->estado = "CONDESCARGO";
            $cambia->save();
        }

        $nuevo_pago->fecha= $request->input('fecha');
        $nuevo_pago->monto = $request->input('monto');
        $nuevo_pago->codigo = $request->input('codigo');
        $nuevo_pago->acta_id = $request->input('acta');
        $nuevo_pago->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Obtener el operativo a actualizar
        $nuevo_pago = Pago::findOrFail($id);
        $cambia = Acta::findOrFail($request->input('acta'));

        if($request->input('inputGroupSelect01') == "INFRACCION" || $request->input('inputGroupSelect01') == "SANCION")
        {
            $cambia->estado = "ARCHIVADO";
        }else if($request->input('inputGroupSelect01') == "RDR"){
            $cambia->estado = "ARCHIVADO";
            $cambia->save();
        }
        else
        {
            $cambia->estado = "CONDESCARGO";
        }

        $cambia->save();

        $nuevo_pago->fecha= $request->input('fecha');
        $nuevo_pago->monto = $request->input('monto');
        $nuevo_pago->codigo = $request->input('codigo');
        $nuevo_pago->acta_id = $request->input('acta');
        $nuevo_pago->save();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
