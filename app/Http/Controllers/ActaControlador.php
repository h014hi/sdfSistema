<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acta;
use App\Models\Inspector;
use App\Models\Empresa;
use App\Models\Conductor;
use App\Models\Pago;
use App\Models\Infraccion;
use App\Models\Operativo;
use App\Models\Vehiculo;




class ActaControlador extends Controller
{

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

        $letraLicencia = $request->input('Letral');
        $dni = $request->input('dni');
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

        $conductor = Conductor::where('dni',$request->input('dni'))->first();
        if($conductor)
        {
            $nuevo_acta->conductor()->associate($conductor);
        }
        else
        {
            $nuevo_conductor = new Conductor;
            $nuevo_conductor->dni = $request->input('dni');

            $nuevo_conductor->nombres = $request->input('nombres');
            $nuevo_conductor->apellidos = $request->input('apellidos');
            $nuevo_conductor->licencia = $licencia;
            $nuevo_conductor->categoria= $request->input('categoria');
            $nuevo_conductor->estadolicencia= $request->input('estadol');
            $nuevo_conductor->save();
            $b = Conductor::where('dni',$request->input('dni'))->first();
            $nuevo_acta->conductor()->associate($b);
        }

        $nuevo_acta->operativo_id= $id;
        $nuevo_acta->numero= $request->input('acta');
        $nuevo_acta->estado= $request->input('condicion_id');
        $nuevo_acta->obs_intervenido = $request->input('obs_intervenido');
        $nuevo_acta->obs_inspector = $request->input('obs_inspector');
        $nuevo_acta->obs_acta = $request->input('obs_acta');
        $nuevo_acta->retencion= $request->input('retencion');
        $nuevo_acta->ruta= $request->input('ruta');
        $nuevo_acta->inspector_id =  $request->input('inspector');
        $nuevo_acta->empresa_id = $request->input('empresas');
        $nuevo_acta->infraccion_id = $request->input('infraccion');
        $nuevo_acta->save();
        return redirect()->back();
    }


    public function editaracta(Request $request, string $id)
    {
        $letraLicencia = $request->input('Letral');
        $dni = $request->input('dni');
        $licencia = $letraLicencia . $dni;
        // Crear un nuevo usuario
        $upacta = Acta::findOrFail($id);
        $upacta->numero= $request->input('acta');
        $upacta->estado= $request->input('condicion_id');
        $upacta->obs_intervenido = $request->input('obs_intervenido');
        $upacta->obs_inspector = $request->input('obs_inspector');
        $upacta->obs_acta = $request->input('obs_acta');
        $upacta->retencion= $request->input('retencion');
        $upacta->ruta= $request->input('ruta');


        //actualizar inspector
        $upacta->inspector_id =  $request->input('inspector');

        $upacta->empresa_id = $request->input('empresas');

        $upacta->infraccion_id = $request->input('infraccion');

        $conductor = Conductor::findOrFail($upacta->conductor_id);

        $conductor->dni = $request->input('dni');
        $conductor->nombres = $request->input('nombres');
        $conductor->apellidos = $request->input('apellidos');
        $conductor->licencia = $licencia; // aqui esta con guion sin guion xd
        $conductor->categoria= $request->input('categoria');
        $conductor->estadolicencia= $request->input('estadol');
        $conductor->save();

        $vehiculo = Vehiculo::findOrFail($upacta->vehiculo_id);
        $vehiculo->placa = $request->input('placa');
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
        $infracciones = Infraccion::all();
        $vehiculos = Vehiculo::all();
        $pagos = Pago::all();
        $actas = Acta::where('operativo_id', $id)->orderBy('updated_at', 'desc')->paginate(5);
        return view('actas', ['resultados'=>$actas, 'inspectores'=>$inspectores, 'empresas'=>$empresas, 'conductores'=>$conductores, 'infracciones'=>$infracciones, 'vehiculos'=>$vehiculos, 'pagos'=>$pagos, 'id'=>$id]);
    }

    // ActaControlador.php

    public function destroy($id)
    {
        $acta = Acta::findOrFail($id);
        $acta->delete();

        return redirect()->back();
    }

}
