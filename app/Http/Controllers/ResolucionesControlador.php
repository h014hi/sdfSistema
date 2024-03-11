<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resolucion;
use App\Models\Acta;

class ResolucionesControlador extends Controller
{
    public function view(){

        return view('consultardr');
    }

    public function buscar(Request $request){
        $request->validate([
            'nrdr' => 'required',
        ]);

        $nrdr = $request->input('nrdr');
        $tipo = $request->input('buscar_por');
        $fecha = $request->input('fecha');

        //TENGO QUE REALIZAR CONSULTA CON FECHA LA FECHA LO TRAE DE OPERATIVO
        if($fecha === NULL)
        {
            if ($tipo === "rdr" and strlen($nrdr) === 4){
                $rdrs = Resolucion::where('n_resolucion', $nrdr)->first();
                if($rdrs)
                {
                    $rdrs = Resolucion::where('n_resolucion', $nrdr)->get();
                    return  view('consultardr',['resultados'=> $rdrs]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a este N° de acta de Control.','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }

            }
            else if ($tipo==="acta"){
                $acta = Acta::where('numero', $nrdr)->first();
                if($acta)
                {
                    $rdrs = Resolucion::where('acta_id', $acta->id)->get();
                    return  view('consultardr',['resultados'=> $rdrs]);
                }
                else
                {
                    return view('consultardr',['mensaje'=>['No se ha encontrado ninguna Resolucion asociada al número ingresado.']]);
                }

            }
            else
            {
                return view('consultardr', ['mensaje'=>['DATOS INGRESADOS INCORRECTOS','Ingrese los datos de manera correcta']]);
            }
        }
        else
        {
            if ($tipo === "rdr" and strlen($nrdr) === 4){

                $acta = Acta::where('numero', $nrdr)->first();
                $fecha = Resolucion::where('fecha', $fecha)->first();
                if($acta and $fecha)
                {
                    $rdrs = Resolucion::where('acta_id', $acta->id);
                    return  view('consultardr',['resultados'=> $rdrs]);
                }
                else
                {
                    return view('consultardr',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a esta fecha','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else if ($tipo==="acta"){

                $rdrs = Resolucion::where('n_resolucion', $nrdr)
                      ->where('fecha', $fecha)
                      ->first();

                if($rdrs)
                {
                    $rdrs = Resolucion::where('n_resolucion', $nrdr)->get();
                    return  view('consultardr',['resultados'=> $rdrs]);
                }
                else
                {
                    return view('consultardr',['mensaje'=>['No se ha encontrado ninguna Resolucion asociada al número ingresado.']]);
                }
            }
            else
            {
                return view('consultardr', ['mensaje'=>['DATOS INGRESADOS INCORRECTOS','Ingrese los datos de manera correcta']]);
            }
        }
    }

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

        $idActa = $request->input('acta');
        $cambia = Acta::findOrFail($idActa);

        $cambia->estadoanterior  = $cambia->estado;
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
        $idActa = $request->input('acta');

        $nueva_resolucion = Resolucion::findOrFail($id);
        $cambia = Acta::findOrFail($idActa);

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
        $acta = $resolucion->acta;
        $resolucion->delete();

        $acta->estado =$acta->estadoanterior;
        $acta->estadoanterior = 'REGISTRADO';
        $acta->save();
        // Redireccionar a la página o realizar alguna acción adicional
        return redirect()->back();
    }
}
