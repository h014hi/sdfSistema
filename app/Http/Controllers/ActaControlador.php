<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta;
use App\Models\Acta_Fracum;
use App\Models\Inspector;
use App\Models\Empresa;
use App\Models\Conductor;
use App\Models\Fracum;
use App\Models\FracumFather;
use App\Models\FracumSon;
use App\Models\Pago;
use App\Models\Operativo;
use App\Models\Vehiculo;
use GuzzleHttp\Client;

class ActaControlador extends Controller
{
    /* API DNI*/
    private static $api_token = 'apis-token-7618.6kqlzDgINL1r2PdJmCVflCwqndnnmWcb';
    /**token temporal maximas solicitudes por mes 1000 gratis mas de eso se debe de pagar */
    private static $base_url = 'https://api.apis.net.pe';

    public function consultarDni(Request $request)
    {
        $dni = $request->input('dni');

        $client = new Client([
            'base_uri' => self::$base_url,
            'verify' => false,
        ]);

        $response = $client->request('GET', '/v2/reniec/dni', [
            'query' => ['numero' => $dni],
            'headers' => [
                'Referer' => 'https://apis.net.pe/consulta-dni-api',
                'Authorization' => 'Bearer ' . self::$api_token,
            ],
        ]);

        $persona = json_decode($response->getBody()->getContents());

        return response()->json($persona);
    }

    /** **************************/

    public function index()
    {
        $resultados = Acta::all();
        return view('actas',['resultados'=>$resultados]);
    }


    //****************************************************************************** */

    public function buscar(Request $request)
    {
        // Lógica de búsqueda aquí
        $request->validate([
            'actadecontrol' => 'required',
        ]);


        // Recupera los valores de los inputs

        //documento
        $numero = $request->input('actadecontrol');
        $tipo = $request->input('tipo');
        $fecha = $request->input('fecha');

        //TENGO QUE REALIZAR CONSULTA CON FECHA LA FECHA LO TRAE DE OPERATIVO
        if($fecha === NULL)
        {
            if ($tipo === "tipo1" and strlen($numero) === 8){

                $conductor = Conductor::where('dni', $numero)->first();
                if($conductor)
                {
                $actas = Acta::where('conductor_id', $conductor->id)->get();
                    return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a este número de DNI.','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else if ($tipo==="tipo2"){

                $actas = Acta::where('numero', $numero)->first();
                if($actas)
                {
                    $actas = Acta::where('numero', $numero)->get();
                    return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a este N° de acta de Control.','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else if($tipo === "tipo3"  and strlen($numero) === 7 )
            {
                $vehiculo = Vehiculo::where('placa', $numero)->first();
                if($vehiculo)
                {
                $actas = Acta::where('vehiculo_id', $vehiculo->id)->get();
                return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a esta placa vehicular','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else
            {
                return view('pagina_principal', ['mensaje'=>['DATOS INGRESADOS INCORRECTOS','Ingrese los datos de manera correcta el DNI tiene 8 digitos, el N° de acta tiene 7 y la placa 6']]);
            }
        }

        else
        {
            if ($tipo === "tipo1" and strlen($numero) === 8){

                $conductor = Conductor::where('dni', $numero)->first();
                $operativo = Operativo::where('fecha', $fecha)->first();
                if($conductor and $operativo)
                {

                $actas = Acta::where('conductor_id', $conductor->id)->where('operativo_id',$operativo->id)->get();
                return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a esta fecha','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else if ($tipo==="tipo2"){

                $actas = Acta::where('numero', $numero)->first();
                $operativo = Operativo::where('fecha', $fecha)->first();

                if($actas and $operativo)
                {
                    $actas = Acta::where('numero', $numero)->where('operativo_id',$operativo->id)->get();
                    return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a esta fecha','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else if($tipo === "tipo3"  and strlen($numero) === 7 )
            {
                $vehiculo = Vehiculo::where('placa', $numero)->first();
                $operativo = Operativo::where('fecha', $fecha)->first();

                if($vehiculo)
                {
                $actas = Acta::where('vehiculo_id', $vehiculo->id)->where('operativo_id',$operativo->id)->get();
                return  view('pagina_principal',['resultados'=> $actas]);
                }
                else
                {
                    return view('pagina_principal',['mensaje'=>['No se ha encontrado ninguna acta de control asociada a esta fecha','Si la intervención tuvo lugar hoy, verifique en el sistema después de transcurridas 24 horas o acérquese a la oficina de la Subdirección de Fiscalización.']]);
                }
            }
            else
            {
                return view('pagina_principal', ['mensaje'=>['DATOS INGRESADOS INCORRECTOS','Ingrese los datos de manera correcta el DNI tiene 8 digitos, el N° de acta tiene 7 y la placa 6']]);
            }
        }
    }


    public function guardaracta(Request $request,string $id)
    {

        $nuevo_acta = new Acta;

        $letraLicencia = $request->input('Letralic');
        $dni = $request->input('n_documento');
        $licencia = $letraLicencia . $dni;

        $vehiculo = Vehiculo::where('placa',$request->input('placa'))->first();
        if($vehiculo)
        {
            $nuevo_acta->vehiculo()->associate($vehiculo);
        }
        else
        {
            $nuevo_vehiculo = new Vehiculo;
            $nuevo_vehiculo->placa = $request->input('placa');
            $nuevo_vehiculo->save();

            $a = Vehiculo::where('placa',$request->input('placa'))->first();
            $nuevo_acta->vehiculo()->associate($a);

        }

        $conductor = Conductor::where('dni',$dni)->first();
        if($conductor)
        {
            $nuevo_acta->conductor()->associate($conductor);
        }
        else
        {
            $nuevo_conductor = new Conductor;
            $nuevo_conductor->dni = $dni;

            $nuevo_conductor->nombres = $request->input('nombres');
            $nuevo_conductor->apellidos = $request->input('apellidos');
            $nuevo_conductor->licencia = $licencia;
            $nuevo_conductor->categoria= $request->input('categoria');
            $nuevo_conductor->estadolicencia= $request->input('estadol');
            $nuevo_conductor->save();
            $b = Conductor::where('dni',$dni)->first();
            $nuevo_acta->conductor()->associate($b);
        }


        $nuevo_acta->operativo_id= $id;
        $nuevo_acta->numero= $request->input('acta');
        $nuevo_acta->estado= $request->input('condicion_id');
        $nuevo_acta->agente= $request->input('agente_infrac');
        $nuevo_acta->obs_intervenido = $request->input('obs_intervenido');
        $nuevo_acta->obs_inspector = $request->input('obs_inspector');
        $nuevo_acta->obs_acta = $request->input('obs_acta');
        $nuevo_acta->retencion= $request->input('retencion');
        $nuevo_acta->ruta= $request->input('ruta');
        $nuevo_acta->inspector_id =  $request->input('inspector');
        $nuevo_acta->empresa_id = $request->input('empresas');
        $nuevo_acta->estadoanterior = 'registrado';
        $nuevo_acta->save();

        $nacta_fracum = new Acta_Fracum();
        $nacta_fracum->acta_id=$nuevo_acta->id;
        $nacta_fracum->fracum_id=$request->input('fracumson');
        $nacta_fracum->save();

        return redirect()->back();
    }


    public function editaracta(Request $request, string $id)
    {

        $dni = $request->input('dniedit');
        // Crear un nuevo usuario
        $upacta = Acta::findOrFail($id);
        $upacta->numero= $request->input('actaedit');

        $upacta->estadoanterior = $upacta->estado;
        $upacta->estado= $request->input('condicion_id');

        $upacta->agente= $request->input('agente_infrac_edit');
        $upacta->obs_intervenido = $request->input('obs_intervenidoedit');
        $upacta->obs_inspector = $request->input('obs_inspectoredit');
        $upacta->obs_acta = $request->input('obs_actaedit');
        $upacta->retencion= $request->input('retencionedit');
        $upacta->ruta= $request->input('rutaedit');


        $upacta->inspector_id =  $request->input('inspectoredit');

        $upacta->empresa_id = $request->input('empresaedit');

        $conductor = Conductor::findOrFail($upacta->conductor_id);

        $conductor->dni = $request->input('dniedit');
        $conductor->nombres = $request->input('nombresedit');
        $conductor->apellidos = $request->input('apellidosedit');
        $conductor->licencia = $request->input('licenciaedit'); // aqui esta con guion sin guion xd
        $conductor->categoria= $request->input('categoriaedit');

        $conductor->estadolicencia= $request->input('estadoedit');
        $conductor->save();

        $vehiculo = Vehiculo::findOrFail($upacta->vehiculo_id);
        $vehiculo->placa = $request->input('placaedit');
        $vehiculo->save();

        $upacta->save();


        // Puedes devolver una respuesta adecuada, como un mensaje de éxito
        return redirect()->back();
    }


    public function show($id)
    {
        $inspectores = Inspector::all();
        $empresas = Empresa::all();
        $conductores = Conductor::all();
        $vehiculos = Vehiculo::all();
        $pagos = Pago::all();
        $fracum = Fracum::all();
        $fracumfather = FracumFather::all();
        $fracumson = FracumSon::all();
        $actas = Acta::where('operativo_id', $id)->orderBy('updated_at', 'desc')->paginate(10);

        $operativo = Operativo::find($id);

        $actas2 = Acta::where('operativo_id', $id)->get();

        // Contar la cantidad total de actas asociadas al operativo
        $cantidadactas = $actas2->count();


        if (!$operativo) {
            // Manejar el caso en que no se encuentra el operativo
            abort(404, 'Operativo no encontrado');
        }
        return view('actas', [
            'resultados'=>$actas,
            'inspectores'=>$inspectores,
            'empresas'=>$empresas,
            'conductores'=>$conductores,
            'vehiculos'=>$vehiculos,
            'pagos'=>$pagos,
            'fracum'=>$fracum,
            'fracumfather'=> $fracumfather,
            'fracumson' => $fracumson,
            'id'=>$id,
            'operativo'=>$operativo,
            'cantidadactas' => $cantidadactas
        ]);
    }

    // ActaControlador.php

    public function destroy($id)
    {
        $acta = Acta::findOrFail($id);
        $acta->delete();

        return redirect()->back();
    }

}
