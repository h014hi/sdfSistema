<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pago;
use App\Models\Acta;
use App\Models\Uit;

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

        $uit = Uit::all();

        return view('pagos', ['pagos' => $pagos_realizados, 'actas' => $actas, 'uit'=>$uit]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $nuevo_pago = new Pago;
        $nuevo_pago->tipo = $request->input('inputGroupSelect01');


        $cambia = Acta::findOrFail($request->input('acta'));

        if($request->input('inputGroupSelect01') == "infraccion")
        {
            $cambia->estadoanterior=$cambia->estado;
            $cambia->estado = "ARCHIVADO";
            $cambia->save();
        }
        else if($request->input('inputGroupSelect01') == "rdr"){
            $cambia->estadoanterior=$cambia->estado;
            $cambia->estado = "CONRDR";
            $cambia->save();
        }
        else if($request->input('inputGroupSelect01') == "descargo")
        {
            $cambia->estadoanterior=$cambia->estado;
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
        $nuevo_pago->tipo = $request->input('inputGroupSelect01');
        $cambia = Acta::findOrFail($request->input('acta'));

        if($request->input('inputGroupSelect01') == "infraccion")
        {
            $cambia->estadoanterior=$cambia->estado;
            $cambia->estado = "ARCHIVADO";
            $cambia->save();
        }
        else if($request->input('inputGroupSelect01') == "rdr"){
            $cambia->estadoanterior=$cambia->estado;
            $cambia->estado = "CONRDR";
            $cambia->save();
        }
        else if($request->input('inputGroupSelect01') == "descargo")
        {
            $cambia->estadoanterior=$cambia->estado;
            $cambia->estado = "CONDESCARGO";
            $cambia->save();
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

        $acta = $pago->acta;
        $pago->delete();

        $acta->estado =$acta->estadoanterior;
        $acta->estadoanterior = 'REGISTRADO';
        $acta->save();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
