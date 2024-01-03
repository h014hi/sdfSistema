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
        $nuevo_operativo->tipo = $request->input('inputGroupSelect01');
        $nuevo_operativo->diashabiles= $request->input('dias');;
        $nuevo_operativo->save();
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
        //
        $request->validate([
            'lugar' => 'required',
            'fecha' => 'required',
        ]);

        // Obtener el operativo a actualizar
        $operativo = Operativo::findOrFail($id);

        // Actualizar los datos del operativo
        $operativo->lugar = $request->input('lugar');
        $operativo->provincia = $request->input('provincia');
        $operativo->distrito = $request->input('distrito');
        $operativo->fecha = $request->input('fecha');
        $operativo->tipo = $request->input('inputGroupSelect01');
        $operativo->diashabiles = $request->input('dias');
        // Actualizar otros campos según sea necesario

        // Guardar los cambios en la base de datos
        $operativo->save();

        // Redireccionar a la página o realizar alguna acción adicional
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
