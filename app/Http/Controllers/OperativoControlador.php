<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operativo;
use App\Models\Acta;
use App\Models\Province;
use App\Models\District;

class OperativoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operativos = Operativo::orderBy('fecha', 'desc')->paginate(5);
        $provinces = Province::all();
        $districts = District::all();
        return view('operativos', [
            'resultados' => $operativos,
            'provinces' => $provinces,
            'districts' => $districts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $nuevo_operativo = new Operativo;
        $nuevo_operativo->lugar= $request->input('lugar');
        $nuevo_operativo->provincia = $request->input('provincia');
        $nuevo_operativo->distrito = $request->input('distrito');
        $nuevo_operativo->fecha= $request->input('fecha');
        $nuevo_operativo->tipo = $request->input('tipo_operativo');
        $nuevo_operativo->diashabiles= $request->input('dias');
        $nuevo_operativo->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //s
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

        $operativo = Operativo::findOrFail($id);

        $operativo->tipo = $request->input('tipo_operativo_edit');
        $operativo->lugar = $request->input('lugar_edit');
        $operativo->provincia = $request->input('provincia_edit');
        $operativo->distrito = $request->input('distrito_edit');
        $operativo->fecha = $request->input('fecha_edit');
        $operativo->diashabiles = $request->input('numero_edit');

        $operativo->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operativo = Operativo::findOrFail($id);
        foreach ($operativo->actas as $acta) {
            $acta->delete();
        }
        $operativo->delete();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
