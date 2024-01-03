<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mostrar = Empresa::orderBy('updated_at', 'desc')->paginate(10);
        return view('empresas',['resultados'=> $mostrar]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function buscarempresas(Request $request)
    {
        $request->validate([
            'razon_social' => 'required',
            'ruc' => 'required',
        ]);
        // Recupera los valores de los inputs
        //documento
        $razon = $request->input('razon_social');
        $ruc = $request->input('ruc');
        $res_funcionamiento = $request->input('res_funcionamiento');
        $partida_electronica = $request->input('partida_electronica');
        $tipo = $request->input('tipo');
            if ($tipo === "tipo1"){
                $buscar1 = Empresa::where('razon_social', $razon)->first();
                return  view('empresas',['buscar1'=> $buscar1]);
                }
            else if ($tipo==="tipo2" and strlen($ruc) === 11){
                $buscar2 = Empresa::where('ruc', $ruc)->first();
                return  view('empresas',['buscar2'=> $buscar2]);
                }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'razon_social'=> 'required',
            'nombres_rep_legal' => 'required',
            'apellidos_rep_legal' => 'required',
            'dni_rep_legal' => 'required',
            'numero_celular' => 'required',
            'ruc' => 'required',
            'res_funcionamiento' => 'required',
            'partida_electronica' => 'required',
            'domicilio' => 'required',
        ]);

        // Crear un nuevo usuario
        $usuario = new Empresa();
        $usuario->razon_social = $request->input('razon_social');
        $usuario->nombres_rep_legal = $request->input('nombres_rep_legal');
        $usuario->apellidos_rep_legal = $request->input('apellidos_rep_legal');
        $usuario->dni_rep_legal = $request->input('dni_rep_legal');
        $usuario->numero_celular = $request->input('numero_celular');
        $usuario->ruc = $request->input('ruc');
        $usuario->res_funcionamiento = $request->input('res_funcionamiento');
        $usuario->partida_electronica = $request->input('partida_electronica');
        $usuario->domicilio = $request->input('domicilio');
        $usuario->save();

        // Puedes devolver una respuesta adecuada, como un mensaje de éxito
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'razon_social'=> 'required',
            'nombres_rep_legal' => 'required',
            'apellidos_rep_legal' => 'required',
            'dni_rep_legal' => 'required',
            'numero_celular' => 'required',
            'ruc' => 'required',
            'res_funcionamiento' => 'required',
            'partida_electronica' => 'required',
            'domicilio' => 'required',
        ]);

        // Crear un nuevo usuario
       // Obtener el operativo a actualizar
        $actualizar = Empresa::findOrFail($id);
        $actualizar->razon_social = $request->input('razon_social');
        $actualizar->nombres_rep_legal = $request->input('nombres_rep_legal');
        $actualizar->apellidos_rep_legal = $request->input('apellidos_rep_legal');
        $actualizar->dni_rep_legal = $request->input('dni_rep_legal');
        $actualizar->numero_celular = $request->input('numero_celular');
        $actualizar->ruc = $request->input('ruc');
        $actualizar->res_funcionamiento = $request->input('res_funcionamiento');
        $actualizar->partida_electronica = $request->input('partida_electronica');
        $actualizar->domicilio = $request->input('domicilio');
        $actualizar->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
