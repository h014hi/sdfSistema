<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

use App\Models\Operativo;
use App\Models\Infraccion;
use App\Models\Empresa;
use App\Models\Acta;
use App\Models\Acta_Fracum;
use App\Models\Pago;

class PDFControlador extends Controller
{
    public function generarDocumento(Request $request, string $id)
    {
        $acta = Acta::findOrFail($id);

        $templatePath = public_path('plantillaifidos.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Establecer el idioma a español
        Carbon::setLocale('es');

        $fecha_actual_timestamp = time();

        // Formatear la fecha en español usando strftime
        $fecha_formateada = Carbon::createFromTimestamp($fecha_actual_timestamp)->isoFormat('D [de] MMMM [de] YYYY');

        $templateProcessor->setValue('fechados', $fecha_formateada);
        $templateProcessor->setValue('director_circulacion', 'Abg. Javier Anibal Yapu Mamani');
        $templateProcessor->setValue('director_fiscalizacion', 'Lic. Máximo Quispe Turpo');
        $templateProcessor->setValue('numero', $acta->numero );
        $templateProcessor->setValue('placa', $acta->vehiculo->placa);
        $templateProcessor->setValue('conductor', $acta->conductor->nombres.' '.$acta->conductor->apellidos);
        $templateProcessor->setValue('ruta', $acta->ruta);
        $templateProcessor->setValue('fecha',strftime($acta->operativo->fecha) );
        $templateProcessor->setValue('lugar',$acta->operativo->lugar);
        $templateProcessor->setValue('propietarios', '(DIGITAR SEGUN SUNARP)');
        $templateProcessor->setValue('licencia', $acta->conductor->licencia);
        $templateProcessor->setValue('categoria', $acta->categoria);


        foreach($acta->fracums as $fracum){
            foreach ($fracum->fSubCods as $subcod){
                $templateProcessor->setValue('fracumfather',$subcod->fFather->codigo);
                $templateProcessor->setValue('fracumson',$subcod->sub_cod);
                $templateProcessor->setValue('fracumfather_detalle',$subcod->fFather->detalle);
                $templateProcessor->setValue('fracumson_descripcion',$subcod->descripcion);
                $templateProcessor->setValue('fracumson_calificacion',$subcod->calificacion);
                $templateProcessor->setValue('fracumson_consecuencia',$subcod->consecuencia);
                $templateProcessor->setValue('fracumson_mpreventivas',$subcod->m_preventivas);
            }
        }


        //GUARDAR EN GOOGLE DRIVE POR ELLO NECESITAREMOS LA API DE GOOGLE DRIVE
        /* Si se puede hacer pero es un poco maas complicado en obtener  el auth y el token */
        $documentoGenerado = storage_path('app/public/documento_generado.docx');
        $templateProcessor->saveAs($documentoGenerado);

        return response()->download($documentoGenerado)->deleteFileAfterSend(true);

    }


    public function mostrarGrafico(Request $request)
    {
        $resultados = NULL;
        $tipo = $request->input('tipo');
        $label = array();
        $datos = array();

        $consulta = Acta_Fracum::join('actas', 'actas.id', '=', 'acta_fracum.acta_id')
            ->join('fracum', 'fracum.id', '=', 'acta_fracum.fracum_id')
            ->join('fracumson', 'fracumson.id', '=', 'fracum.fracumson_id')
            ->join('fracumfather', 'fracumfather.id', '=', 'fracum.fracumfather_id');


        if ($request->input('fecha_inicio') == NULL && $request->input('fecha_fin')== NULL) {
            if($tipo=='infraccion'){
                $consulta->selectRaw('COUNT(actas.id) AS cantidad_actas')
                ->selectRaw("CONCAT(fracumfather.codigo, ' ', fracumson.sub_cod) AS tablaTempo")
                ->where('fracum.tipo', '=', 'infraccion')
                ->groupBy('fracumfather.codigo', 'fracumson.sub_cod');
            }else{
                $consulta->selectRaw('COUNT(actas.id) AS cantidad_actas')
                ->selectRaw('fracumfather.codigo AS tablaTempo')
                ->where('fracum.tipo', '=', 'incumplimiento')
                ->groupBy('fracumfather.codigo');
            }
            $resultados = $consulta->pluck('cantidad_actas', 'tablaTempo');
        }else{
            if($tipo=='infraccion'){
                $consulta->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                    ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                    ->selectRaw("CONCAT(fracumfather.codigo, ' ', fracumson.sub_cod) AS tablaTempo")
                    ->where('fracum.tipo', '=', 'infraccion')
                    ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                    ->groupBy('fracumfather.codigo', 'fracumson.sub_cod');
            }else{
                $consulta->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                ->selectRaw('fracumfather.codigo AS tablaTempo')
                ->where('fracum.tipo', '=', 'incumplimiento')
                ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                ->groupBy('fracumfather.codigo');
            }
            $resultados = $consulta->pluck('cantidad_actas', 'tablaTempo');
        }

        foreach ($resultados as $incumplimiento => $cantidad) {
            array_push($label, $incumplimiento);
            array_push($datos, $cantidad);
        }

        $empresas = Empresa::all();
        return view('grafico', ['label' => $label, 'datos' => $datos,'tipo'=>$tipo, 'empresas'=>$empresas] );
    }

    public function dompdfCoonfiguration(){
         // Configurar opciones de Dompdf
         $options = new Options();
         $options->set('isHtml5ParserEnabled', true);
         $options->set('isRemoteEnabled', true);

         // Crear instancia de Dompdf
         $dompdf = new Dompdf($options);

         return $dompdf;
    }

    public function generarreporte(Request $request)
    {
        $tiporeporte = $request->input('tipo_reporte');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechahoy = Carbon::now()->isoFormat('DD [de] MMMM [del] YYYY');
        $fechaInicio=$request->input('fecha_inicio');
        $fechaFin=$request->input('fecha_fin');

        if ($tiporeporte == "OPERATIVO") {

            $datos = Operativo::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

            $total_operativos = $datos->count();
            $total_actas = $datos->sum(function ($operativo) {
                return count(json_decode($operativo->actas, true));
            });

            $dompdf = $this->dompdfCoonfiguration();

            $pdfData = [
                'fechaInicio'=>$fechaInicio,
                'fechaFin'=>$fechaFin,
                'fechahoy' => $fechahoy,
                'total_operativos' => $total_operativos,
                'total_actas' => $total_actas,
                'operativos' => $datos
            ];

            $html = view('template/plantillapdf', $pdfData)->render();

            $dompdf->loadHtml($html);
            $dompdf->render();
            return $dompdf->stream('reporte_operativo.pdf');

        }elseif($tiporeporte == "INFRACCION"){
            if($request->input('consulta_por') == "empresa"){

                $datosempresa = Empresa::find($request->input('empresas'));

                $dompdf = $this->dompdfCoonfiguration();

                /* Parar el grafico */
                $label = [];
                $datos = [];
                $archivados = [];
                $label_incum = [];
                $datos_incum = [];
                $archivados_incum = [];

                $fechaInicio=$request->input('fecha_inicio');
                $fechaFin=$request->input('fecha_fin');
                $acta_fracum = Acta_Fracum::all();

                $resultados_infracciones = Acta_Fracum::join('actas', 'actas.id', '=', 'acta_fracum.acta_id')
                    ->join('empresas', 'empresas.id', '=', 'actas.empresa_id')
                    ->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                    ->join('fracum', 'fracum.id', '=', 'acta_fracum.fracum_id')
                    ->join('fracumson', 'fracumson.id', '=', 'fracum.fracumson_id')
                    ->join('fracumfather', 'fracumfather.id', '=', 'fracum.fracumfather_id')
                    ->selectRaw("CONCAT(fracumfather.codigo, ' ', fracumson.sub_cod) AS infracciones")
                    ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                    ->selectRaw('SUM(CASE WHEN actas.estado = "ARCHIVADO" THEN 1 ELSE 0 END) AS archivados')
                    ->where('fracum.tipo', 'infraccion')
                    ->where('empresas.id', $request->input('empresas'))
                    ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($query) use ($request) {
                        return $query->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
                    })
                    ->groupBy('fracumfather.codigo', 'fracumson.sub_cod')
                    ->get();


                $resultados_incumplimientos = Acta_Fracum::join('actas', 'actas.id', '=', 'acta_fracum.acta_id')
                        ->join('empresas', 'empresas.id', '=', 'actas.empresa_id')
                        ->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                        ->join('fracum', 'fracum.id', '=', 'acta_fracum.fracum_id')
                        ->join('fracumson', 'fracumson.id', '=', 'fracum.fracumson_id')
                        ->join('fracumfather', 'fracumfather.id', '=', 'fracum.fracumfather_id')
                        ->selectRaw("CONCAT(fracumfather.codigo) AS incumplimientos")
                        ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                        ->selectRaw('SUM(CASE WHEN actas.estado = "ARCHIVADO" THEN 1 ELSE 0 END) AS archivados')
                        ->where('fracum.tipo', 'incumplimiento')
                        ->where('empresas.id', $request->input('empresas'))
                        ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($query) use ($request) {
                            return $query->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
                        })
                        ->groupBy('fracumfather.codigo')
                        ->get();



                foreach ($resultados_infracciones as $resultado) {
                    array_push($label,$resultado->infracciones);
                    array_push($datos, $resultado->cantidad_actas);
                    array_push($archivados, $resultado->archivados);
                }

                foreach ($resultados_incumplimientos as $resultado) {
                    array_push($label_incum,$resultado->incumplimientos);
                    array_push($datos_incum, $resultado->cantidad_actas);
                    array_push($archivados_incum, $resultado->cantidad_actas);
                }

                /* */
                $pdfData = [
                    'datosempresa'=>$datosempresa,
                    'fechahoy' => $fechahoy,
                    'fechaInicio'=>$fechaInicio,
                    'fechaFin'=>$fechaFin,
                    'label' => $label,
                    'datos' => $datos,
                    'archivados' => $archivados,
                    'label_incum' => $label_incum,
                    'datos_incum' => $datos_incum,
                    'archivados_incum' => $archivados_incum,
                    'acta_fracum' => $acta_fracum,
                ];

                $html = view('template/plantillaempresas', $pdfData)->render();

                $dompdf->loadHtml($html);
                $dompdf->render();
                return $dompdf->stream('reporte_infracciones_empresas.pdf');
            }else{
                $dompdf = $this->dompdfCoonfiguration();

                /* Parar el grafico */
                $label = [];
                $datos = [];
                $archivados = [];
                $label_incum = [];
                $datos_incum = [];
                $archivados_incum = [];

                $fechaInicio=$request->input('fecha_inicio');
                $fechaFin=$request->input('fecha_fin');
                $acta_fracum = Acta_Fracum::all();

                $resultados_infracciones = Acta_Fracum::join('actas', 'actas.id', '=', 'acta_fracum.acta_id')
                    ->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                    ->join('fracum', 'fracum.id', '=', 'acta_fracum.fracum_id')
                    ->join('fracumson', 'fracumson.id', '=', 'fracum.fracumson_id')
                    ->join('fracumfather', 'fracumfather.id', '=', 'fracum.fracumfather_id')
                    ->selectRaw("CONCAT(fracumfather.codigo, ' ', fracumson.sub_cod) AS infracciones")
                    ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                    ->selectRaw('SUM(CASE WHEN actas.estado = "ARCHIVADO" THEN 1 ELSE 0 END) AS archivados')
                    ->where('fracum.tipo', 'infraccion')
                    ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($query) use ($request) {
                        return $query->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
                    })
                    ->groupBy('fracumfather.codigo', 'fracumson.sub_cod')
                    ->get();


                $resultados_incumplimientos = Acta_Fracum::join('actas', 'actas.id', '=', 'acta_fracum.acta_id')
                        ->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                        ->join('fracum', 'fracum.id', '=', 'acta_fracum.fracum_id')
                        ->join('fracumson', 'fracumson.id', '=', 'fracum.fracumson_id')
                        ->join('fracumfather', 'fracumfather.id', '=', 'fracum.fracumfather_id')
                        ->selectRaw("CONCAT(fracumfather.codigo) AS incumplimientos")
                        ->selectRaw('COUNT(actas.id) AS cantidad_actas')
                        ->selectRaw('SUM(CASE WHEN actas.estado = "ARCHIVADO" THEN 1 ELSE 0 END) AS archivados')
                        ->where('fracum.tipo', 'incumplimiento')
                        ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($query) use ($request) {
                            return $query->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
                        })
                        ->groupBy('fracumfather.codigo')
                        ->get();



                foreach ($resultados_infracciones as $resultado) {
                    array_push($label,$resultado->infracciones);
                    array_push($datos, $resultado->cantidad_actas);
                    array_push($archivados, $resultado->archivados);
                }

                foreach ($resultados_incumplimientos as $resultado) {
                    array_push($label_incum,$resultado->incumplimientos);
                    array_push($datos_incum, $resultado->cantidad_actas);
                    array_push($archivados_incum, $resultado->cantidad_actas);
                }

                /* */
                $pdfData = [
                    'fechahoy' => $fechahoy,
                    'fechaInicio'=>$fechaInicio,
                    'fechaFin'=>$fechaFin,
                    'label' => $label,
                    'datos' => $datos,
                    'archivados' => $archivados,
                    'label_incum' => $label_incum,
                    'datos_incum' => $datos_incum,
                    'archivados_incum' => $archivados_incum,
                    'acta_fracum' => $acta_fracum,
                ];

                $html = view('template/plantillafracum', $pdfData)->render();

                $dompdf->loadHtml($html);
                $dompdf->render();
                return $dompdf->stream('reporte_infracciones.pdf');
            }
        }else{
            $dompdf = $this->dompdfCoonfiguration();

            /* Parar el grafico */
            $p_infraccion = 0;
            $p_descargo = 0;
            $p_tramite = 0;
            $p_rdr = 0;

            $fechaInicio=$request->input('fecha_inicio');
            $fechaFin=$request->input('fecha_fin');
            $acta_fracum = Acta_Fracum::all();

            $resultados = Pago::join('actas', 'actas.id', '=', 'pagos.acta_id')
                ->join('operativos', 'operativos.id', '=', 'actas.operativo_id')
                ->selectRaw('SUM(CASE WHEN pagos.tipo = "infraccion" THEN pagos.monto ELSE 0 END) AS p_infraccion')
                ->selectRaw('SUM(CASE WHEN pagos.tipo = "descargo" THEN pagos.monto ELSE 0 END) AS p_descargo')
                ->selectRaw('SUM(CASE WHEN pagos.tipo = "tramite" THEN pagos.monto ELSE 0 END) AS p_tramite')
                ->selectRaw('SUM(CASE WHEN pagos.tipo = "rdr" THEN pagos.monto ELSE 0 END) AS p_rdr')
                ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function ($query) use ($request) {
                    return $query->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]);
                })
                ->get();

            foreach ($resultados as $resultado) {
                $p_infraccion=$resultado->p_infraccion;
                $p_descargo =$resultado->p_descargo;
                $p_tramite =$resultado->p_tramite;
                $p_rdr =$resultado->p_rdr;
            }

            $pdfData = [
                'fechahoy' => $fechahoy,
                'fechaInicio'=>$fechaInicio,
                'fechaFin'=>$fechaFin,
                'p_infraccion'=>$p_infraccion,
                'p_descargo'=>$p_descargo,
                'p_tramite'=>$p_tramite,
                'p_rdr'=>$p_rdr,
            ];

            $html = view('template/plantillapagos', $pdfData)->render();

            $dompdf->loadHtml($html);
            $dompdf->render();
            return $dompdf->stream('reporte_pagos.pdf');

        }
    }
}
