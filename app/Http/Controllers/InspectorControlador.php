<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspector;

class InspectorControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inspectores = Inspector::orderBy('updated_at', 'desc')->paginate(5);
        return view('inspectores',['resultados'=> $inspectores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function buscar(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'acreditado' => 'required',
        ]);

        // Crear un nuevo usuario
        $usuario = new Inspector();
        $usuario->nombres = $request->input('nombres');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->dni = $request->input('inspecdni');
        $usuario->telefono = $request->input('telefono');
        $usuario->rdrauto = $request->input('rdrauto');
        $usuario->acreditado = $request->input('acreditado');
        $usuario->save();

        // Puedes devolver una respuesta adecuada, como un mensaje de éxito
        return redirect()->route('inspectores');
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
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
        ]);

        // Obtener el operativo a actualizar
        $inspec = Inspector::findOrFail($id);

        // Actualizar los datos del operativo
        $inspec->nombres = $request->input('nombres');
        $inspec->apellidos = $request->input('apellidos');
        $inspec->dni = $request->input('inspecdni');
        $inspec->telefono = $request->input('telefono');
        $inspec->rdrauto = $request->input('rdrauto');
        $inspec->acreditado = $request->input('acreditado');
        // Actualizar otros campos según sea necesario

        // Guardar los cambios en la base de datos
        $inspec->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inspector = Inspector::findOrFail($id);
        $inspector->delete();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
