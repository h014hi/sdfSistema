<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

use App\Models\Operativo;
use App\Models\Infraccion;
use App\Models\Empresa;
use App\Models\Acta;
use App\Models\Pago;

class PDFControlador extends Controller
{
    public function generarPDF()
    {
        $dompdf = new Dompdf();
       
        $datos = Operativo::all();

        // Componer el HTML
        $html = '<center><h1>Reporte PDF</h1></center>';
        $html .= '<table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%; text-align: center; font-size:12px; ">';
        $html .= '<thead style="background-color: #f5f5f5;">';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:15%;">FECHA</th>';
        $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:15%;">N° DE OPERATIVOS</th>';
        $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:24%;">TIPO DE OPERATIVO</th>';
        $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:23%;">LUGAR DE INTERVENCIÓN</th>';
        $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:25%;">N° DE ACTAS DE CONTROL IMPUESTAS</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        

        $total_operativos = 0;
        $total_actas = 0;
        
        foreach ($datos as $item) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->fecha . '</td>';
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">01</td>';
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->tipo . '</td>';
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->lugar . '</td>';
            
            $actas = json_decode($item->actas, true);
            $cantidadActas = count($actas);
            $total_actas+=$cantidadActas;
            if($cantidadActas>9)
            {
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $cantidadActas . '</td>';
            }
            else
            {
                $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $cantidadActas . '</td>';   
            }
            $html .= '</tr>';
            $total_operativos+=1;
        }

        $html .= '<tr>';
        $html .= '<td style="border: 1px solid #ddd; padding: 8px;"><b>TOTAL</b></td>';
        if($total_operativos >9)
            {
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $total_operativos . '</td>';
            }
            else
            {
                $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $total_operativos . '</td>';   
            }
        $html .= '<td style="border: 1px solid #ddd; padding: 8px;" colspan="2"></td>';
        if($total_actas >9)
            {
            $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $total_actas . '</td>';
            }
            else
            {
                $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $total_actas . '</td>';   
            }
        $html .= '</tr>';


        $html .= '</tbody>';
        $html .= '</table>';
        
        // Resto del código...
        // Añadir el HTML a dompdf
            $dompdf->loadHtml($html);
                    
            //Establecer el tamaño de hoja en DOMPDF
            $dompdf->setPaper('A4', 'portrait');
            
            // Renderizar el PDF
            $dompdf->render();
            
            // Forzar descarga del PDF
            $dompdf->stream("REPORTEOPERATIVO.pdf", [ "Attachment" => true]);

        return redirect()->back();
    }


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
        $templateProcessor->setValue('propietarios', 'EN DESARROLLO');
        $templateProcessor->setValue('licencia', $acta->conductor->licencia);
        $templateProcessor->setValue('categoria', $acta->categoria);
        $templateProcessor->setValue('lugar',$acta->operativo->lugar);

        //GUARDAR EN GOOGLE DRIVE POR ELLO NECESITAREMOS LA API DE GOOGLE DRIVE
        $documentoGenerado = storage_path('app/public/documento_generado.docx');
        $templateProcessor->saveAs($documentoGenerado);


        //DESCARGAR CONVERTIDO A PDF

        // Convertir el documento de Word a PDF
        //$dompdf = new Dompdf();
        //$dompdf->loadHtmlFile($documentoGenerado);
        //$dompdf->render();

        //// Guardar el documento generado en formato PDF
        //$documentoPDF = storage_path('app/public/documento_generado.pdf');
        //file_put_contents($documentoPDF, $dompdf->output());

        //// Descargar el documento PDF
        //return response()->download($documentoPDF)->deleteFileAfterSend(true)

        // Descargar el documento y eliminarlo del lugar donde se guardo
        return response()->download($documentoGenerado)->deleteFileAfterSend(true);
        
    }


    public function mostrarGrafico(Request $request)
    {
        
        $labels = array();
        $datos = array();

        if($request->input('fecha_inicio') == NULL && $request->input('fecha_fin')== NULL)
        {
            $infracciones = Infraccion::all();

            foreach($infracciones as $infraccion)
            {
                array_push($labels,$infraccion->codigo);
                $actas = Acta::where('infraccion_id',$infraccion->id)->get();
                array_push($datos,count($actas));
            }
        }

        else {
            
            $infracciones = Infraccion::all();

            foreach($infracciones as $infraccion)
            {
                array_push($labels,$infraccion->codigo);

                $actas = Acta::join('operativos', 'actas.operativo_id', '=', 'operativos.id')
                ->where('infraccion_id', $infraccion->id)
                ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')]) // Ordenar por fecha de manera descendente
                ->get();
                array_push($datos,count($actas));
            }

        }        

        return view('grafico', compact('labels', 'datos'));
    }



    public function generarreporte(Request $request)
    {
        $tiporeporte = $request->input('tipo_reporte');
        $fechahoy = date('d \d\e F \d\e\l Y');

        if($tiporeporte == "OPERATIVO")
        {
            $dompdf = new Dompdf();
       
                $datos = Operativo::whereBetween('fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])->get();
                
                // Componer el HTML
                $html = '<center><h1>REPORTE DE OPERATIVOS</h1></center>';
                $html .= '<center><p>Fecha de consulta: '.$fechahoy.'</p></center>';
                $html .= '<table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%; text-align: center; font-size:12px; ">';
                $html .= '<thead style="background-color: #f5f5f5;">';
                $html .= '<tr>';
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:15%;">FECHA</th>';
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:15%;">N° DE OPERATIVOS</th>';
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:24%;">TIPO DE OPERATIVO</th>';
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:23%;">LUGAR DE INTERVENCIÓN</th>';
                $html .= '<th style="border: 1px solid #ddd; padding: 8px; width:25%;">N° DE ACTAS DE CONTROL IMPUESTAS</th>';
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                

                $total_operativos = 0;
                $total_actas = 0;
                
                foreach ($datos as $item) {
                    $html .= '<tr>';
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->fecha . '</td>';
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">01</td>';
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->tipo . '</td>';
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $item->lugar . '</td>';
                    
                    $actas = json_decode($item->actas, true);
                    $cantidadActas = count($actas);
                    $total_actas+=$cantidadActas;
                    if($cantidadActas>9)
                    {
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $cantidadActas . '</td>';
                    }
                    else
                    {
                        $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $cantidadActas . '</td>';   
                    }
                    $html .= '</tr>';
                    $total_operativos+=1;
                }

                $html .= '<tr>';
                $html .= '<td style="border: 1px solid #ddd; padding: 8px;"><b>TOTAL</b></td>';
                if($total_operativos >9)
                    {
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $total_operativos . '</td>';
                    }
                    else
                    {
                        $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $total_operativos . '</td>';   
                    }
                $html .= '<td style="border: 1px solid #ddd; padding: 8px;" colspan="2"></td>';
                if($total_actas >9)
                    {
                    $html .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $total_actas . '</td>';
                    }
                    else
                    {
                        $html .= '<td style="border: 1px solid #ddd; padding: 8px;">0' . $total_actas . '</td>';   
                    }
                $html .= '</tr>';


                $html .= '</tbody>';
                $html .= '</table>';
                
                // Resto del código...
                // Añadir el HTML a dompdf
                    $dompdf->loadHtml($html);
                            
                    //Establecer el tamaño de hoja en DOMPDF
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Renderizar el PDF
                    $dompdf->render();
                    
                    // Forzar descarga del PDF
                    $dompdf->stream("REPORTEOPERATIVO.pdf", [ "Attachment" => true]);

                return redirect()->back();
        }
        else if($tiporeporte == "INFRACCION")
        {
            if($request->input('consulta_por') == "empresa")
                {
                
                $datoss = Infraccion::all();
                
                //join('operativo', 'acta.operativo_id', '=', 'operativo.id')
                //        ->where('acta.empresa_id', $request->input('empresas'))
                //        ->whereBetween('operativo.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                //        ->get();

            
                    $datosempresa = Empresa::where('id',$request->input('empresas'))->first();

                    //$datosempresa = json_decode($datosempresa, true);
                    $html = '<hr>';
                    $html .=' <h5 style="text-align: center;">REPORTE DE EMPRESA POR ACTAS</h5>';
                    $html .=' <h2 style="text-align: center;">'.$datosempresa->razon_social.'</h2>';
                    $html .=' <h5 style="text-align: center;">SUBDIRECCIÓN DE FISCALIZACIÓN</h5>';
                    $html .='<hr>';

                   
                    $fechahoy = date('d \d\e F \d\e\l Y');

                    $html.=' <p style="text-align: left;"><i><b>GERENTE DE LA EMPRESA: </b>'.$datosempresa->nombres_rep_legal.' '.$datosempresa->apellidos_rep_legal.'</p></i>';
                    $html.=' <p style="text-align: left;"><i><b>FECHA DE CONSULTA: </b>'.$fechahoy.'</p></i>';



                    //GENERAR GRAFICO PARA MI PD

                    $labels = [];
                    $datos = [];

                    foreach ($datoss as $infraccion) {

                        $actas = Acta::join('operativos', 'actas.operativo_id', '=', 'operativos.id')
                        ->join('empresas', 'actas.empresa_id', '=', 'empresas.id')
                            ->where('infraccion_id', $infraccion->id)
                            ->where('empresas.id', $request->input('empresas'))
                            ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                            ->get();

                        
                        array_push($labels, $infraccion->codigo);
                        array_push($datos, count($actas));
                    }

                    //IMAGEN GRAFICADO

                            $svgContent = '
                                <svg height="200" width="500" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            ';

                            $barWidth = 50; // Ancho de las barras (puedes ajustarlo según tus necesidades)
                            $barMargin = 10; // Margen entre cada barra (puedes ajustarlo según tus necesidades)
                            $maxHeight = 150; // Altura máxima de las barras (puedes ajustarlo según tus necesidades)

                            // Generar los rectángulos, etiquetas y valores en el eje X e Y para cada barra
                            for ($i = 0; $i < count($datos); $i++) {
                                $x = $i * ($barWidth + $barMargin);
                                $y = $maxHeight - ($datos[$i] * ($maxHeight / max($datos))); // Ajustar la altura en función del dato máximo

                                // Generar el rectángulo de la barra
                                $svgContent .= '
                                    <rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . ($datos[$i] * ($maxHeight / max($datos))) . '" fill="#ebd231" />
                                ';

                                // Generar la etiqueta en el eje X
                                $svgContent .= '
                                    <text x="' . ($x + $barWidth / 2) . '" y="' . ($maxHeight + 20) . '" text-anchor="middle">' . $labels[$i] . '</text>
                                ';

                                // Generar el valor en el eje Y
                                $svgContent .= '
                                    <text x="' . ($x + $barWidth / 2) . '" y="' . ($y - 5) . '" text-anchor="middle">' . $datos[$i] . '</text>
                                ';
                            }

                            $svgContent .= '
                                </svg>
                            ';

                            $file = tempnam(sys_get_temp_dir(), 'svg');
                            file_put_contents($file, $svgContent);


                            // Agregar el contenido SVG del gráfico al HTML del PDF
                            $html .='<br>';
                            $html .='<center><h3>GRAFICO ESTADISTICO</h3></center>';
                            $html .= '
                            
                            <div style="padding: 15px;">
                            <img src="data:image/svg+xml;base64,' . base64_encode(file_get_contents($file)) . '"/>
                            </div>
                            
                            ';


                    $html.=' <table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">';
                    $html.='     <thead>';
                    $html.='         <tr>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ID</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">TIPO</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ARCHIVADAS</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">PENDIENTES</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">CANTIDAD</th>';
                    $html.='         </tr>';
                    $html.='     </thead>';
                    $html.='     <tbody>';


                    $infracciones = 0;
                    $incumplimientos = 0;
                    $archivado_i = 0;
                    $archivado_j = 0;
                          
                    foreach ($datoss as $dato)
                    {
                    
                    foreach($dato->actas as $acta)
                    {
                        
                        if($acta->operativo->fecha >= $request->input('fecha_inicio') && $acta->operativo->fecha <= $request->input('fecha_fin') && $acta->empresa_id == $request->input('empresas') )
                        {
                            if($acta->infraccion->tipo == "INFRACCION")
                            {
                                if($acta->estado == "ARCHIVADO")
                                {
                                    $archivado_i+=1;
                                }
                                $infracciones+=1;
                            }

                            if($acta->infraccion->tipo == "INCUMPLIMIENTO")
                            {
                                if($acta->estado == "ARCHIVADO")
                                {
                                    $archivado_j+=1;
                                }
                                $incumplimientos+=1;
                            }
                        }
                        
                    }
    
                    }


                    $html.='<tr>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">1</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">INFRACCIONES</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$archivado_i.'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.($infracciones - $archivado_i).'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$infracciones.'</td>';
                        $html.='</tr>';


                        $html.='<tr>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">2</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">INCUMPLIMIENTOS</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$archivado_j.'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.($incumplimientos - $archivado_j).'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$incumplimientos.'</td>';
                        $html.='</tr>';

                        $html.='<tr>';
                        $html .= '<td style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;" colspan="4">CANTIDAD TOTAL DE ACTAS IMPUESTAS</td>';
                        $html .= '<td style="border: 1px solid #ddd; padding: 8px;">'.($infracciones + $incumplimientos).'</td>';
                        $html.='</tr>';
                    $html.='     </tbody>';
                    $html.=' </table>';

                    $html.='<i style="text-align: center;">El reporte y el gráfico se genero a partir de todas las actas impuestas entre las fechas ('.$request->input('fecha_inicio').' ; '.$request->input('fecha_fin').')</i>';

                    
                    $dompdf = new Dompdf();

                    $dompdf->loadHtml($html);
                            
                    //Establecer el tamaño de hoja en DOMPDF
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Renderizar el PDF
                    $dompdf->render();
                    
                    // Forzar descarga del PDF
                    $dompdf->stream("EMPRESAREPORTE.pdf", [ "Attachment" => true]);

                    unlink($file);

                    return redirect()->back();
                }
            else
            {
                $datoss = Infraccion::all();
                
                    //$datosempresa = json_decode($datosempresa, true);
                    $html = '<hr>';
                    $html .=' <h5 style="text-align: center;">REPORTE DE INFRACCIONES E INCUMPLIMIENTOS</h5>';
                    $html .=' <h5 style="text-align: center;">SUBDIRECCIÓN DE FISCALIZACIÓN</h5>';
                    $html .='<hr>';

                   
                    $fechahoy = date('d \d\e F \d\e\l Y');
                    $html.=' <p style="text-align: left;"><i><b>FECHA DE CONSULTA: </b>'.$fechahoy.'</p></i>';



                    //GENERAR GRAFICO PARA MI PD

                    $labels = [];
                    $datos = [];

                    foreach ($datoss as $infraccion) {

                        $actas = Acta::join('operativos', 'actas.operativo_id', '=', 'operativos.id')
                            ->where('infraccion_id', $infraccion->id)
                            ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                            ->get();
                        array_push($labels, $infraccion->codigo);
                        array_push($datos, count($actas));
                    }

                    //IMAGEN GRAFICADO

                            $svgContent = '
                                <svg height="200" width="500" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            ';

                            $barWidth = 50; // Ancho de las barras (puedes ajustarlo según tus necesidades)
                            $barMargin = 10; // Margen entre cada barra (puedes ajustarlo según tus necesidades)
                            $maxHeight = 150; // Altura máxima de las barras (puedes ajustarlo según tus necesidades)

                            // Generar los rectángulos, etiquetas y valores en el eje X e Y para cada barra
                            for ($i = 0; $i < count($datos); $i++) {
                                $x = $i * ($barWidth + $barMargin);
                                $y = $maxHeight - ($datos[$i] * ($maxHeight / max($datos))); // Ajustar la altura en función del dato máximo

                                // Generar el rectángulo de la barra
                                $svgContent .= '
                                    <rect x="' . $x . '" y="' . $y . '" width="' . $barWidth . '" height="' . ($datos[$i] * ($maxHeight / max($datos))) . '" fill="#ebd231" />
                                ';

                                // Generar la etiqueta en el eje X
                                $svgContent .= '
                                    <text x="' . ($x + $barWidth / 2) . '" y="' . ($maxHeight + 20) . '" text-anchor="middle">' . $labels[$i] . '</text>
                                ';

                                // Generar el valor en el eje Y
                                $svgContent .= '
                                    <text x="' . ($x + $barWidth / 2) . '" y="' . ($y - 5) . '" text-anchor="middle">' . $datos[$i] . '</text>
                                ';
                            }

                            $svgContent .= '
                                </svg>
                            ';

                            $file = tempnam(sys_get_temp_dir(), 'svg');
                            file_put_contents($file, $svgContent);


                            // Agregar el contenido SVG del gráfico al HTML del PDF
                            $html .='<br>';
                            $html .='<center><h3>GRAFICO ESTADISTICO</h3></center>';
                            $html .= '
                            
                            <div style="padding: 15px;">
                            <img src="data:image/svg+xml;base64,' . base64_encode(file_get_contents($file)) . '"/>
                            </div>
                            
                            ';


                    $html.=' <table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">';
                    $html.='     <thead>';
                    $html.='         <tr>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ID</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">TIPO</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">ARCHIVADAS</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">PENDIENTES</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">CANTIDAD</th>';
                    $html.='         </tr>';
                    $html.='     </thead>';
                    $html.='     <tbody>';


                    $infracciones = 0;
                    $incumplimientos = 0;
                    $archivado_i = 0;
                    $archivado_j = 0;
                          
                    foreach ($datoss as $dato)
                    {

                    foreach($dato->actas as $acta)
                    {
                        
                        if($acta->operativo->fecha >= $request->input('fecha_inicio') && $acta->operativo->fecha <= $request->input('fecha_fin'))
                        {
                            if($acta->infraccion->tipo == "INFRACCION")
                            {
                                if($acta->estado == "ARCHIVADO")
                                {
                                    $archivado_i+=1;
                                }
                                $infracciones+=1;
                            }

                            if($acta->infraccion->tipo == "INCUMPLIMIENTO")
                            {
                                if($acta->estado == "ARCHIVADO")
                                {
                                    $archivado_j+=1;
                                }
                                $incumplimientos+=1;
                            }
                        }
                        
                    }
    
                    }


                    $html.='<tr>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">1</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">INFRACCIONES</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$archivado_i.'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.($infracciones - $archivado_i).'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$infracciones.'</td>';
                        $html.='</tr>';


                        $html.='<tr>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">2</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">INCUMPLIMIENTOS</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$archivado_j.'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.($incumplimientos - $archivado_j).'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$incumplimientos.'</td>';
                        $html.='</tr>';

                        $html.='<tr>';
                        $html .= '<td style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;" colspan="4">CANTIDAD TOTAL DE ACTAS IMPUESTAS</td>';
                        $html .= '<td style="border: 1px solid #ddd; padding: 8px;">'.($infracciones + $incumplimientos).'</td>';
                        $html.='</tr>';
                    $html.='     </tbody>';
                    $html.=' </table>';

                    $html.='<hr>';

                    $html.=' <table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">';
                    $html.='     <thead>';
                    $html.='         <tr>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">CODIGO DE LA FALTA</th>';
                    $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">CANTIDAD TOTAL</th>';
                    $html.='         </tr>';
                    $html.='     </thead>';
                    $html.='     <tbody>';


                    foreach ($datoss as $infraccion) {

                        $actas = Acta::join('operativos', 'actas.operativo_id', '=', 'operativos.id')
                            ->where('infraccion_id', $infraccion->id)
                            ->whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
                            ->get();
                        
                            $archivado_i = 0;
                            $archivado_j = 0;

                        $html.='<tr>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$infraccion->codigo.'</td>';
                        $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$actas->count().'</td>';
                        $html.='</tr>';        
                    }

                    $html.='     </tbody>';
                    $html.=' </table>';

                    $html.='<i style="text-align: center;">El reporte y el gráfico se genero a partir de todas las actas impuestas entre las fechas ('.$request->input('fecha_inicio').' ; '.$request->input('fecha_fin').')</i>';

                    
                    $dompdf = new Dompdf();

                    $dompdf->loadHtml($html);
                            
                    //Establecer el tamaño de hoja en DOMPDF
                    $dompdf->setPaper('A4', 'portrait');
                    
                    // Renderizar el PDF
                    $dompdf->render();
                    
                    // Forzar descarga del PDF
                    $dompdf->stream("GENERALREPORTE.pdf", [ "Attachment" => true]);

                    unlink($file);

                    return redirect()->back();   
            }
        }
        else
        {
            $operativos = Operativo::whereBetween('operativos.fecha', [$request->input('fecha_inicio'), $request->input('fecha_fin')])
            ->get();
                
            //$datosempresa = json_decode($datosempresa, true);
            $html = '<hr>';
            $html .=' <h2 style="text-align: center;">REPORTE DE PAGOS</h2>';
            $html .=' <h5 style="text-align: center;">SUBDIRECCIÓN DE FISCALIZACIÓN</h5>';
            $html .='<hr>';

           
            $fechahoy = date('d \d\e F \d\e\l Y');
            $html.=' <p style="text-align: left;"><i><b>FECHA DE CONSULTA: </b>'.$fechahoy.'</p></i>';

            $html.=' <table style="width: 100%; border-collapse: collapse; margin: auto; border: 1px solid #ccc; text-align: center;">';
            $html.='     <thead>';
            $html.='         <tr>';
            $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">TIPO DE PAGO</th>';
            $html.='             <th style="border: 1px solid #ccc; padding: 8px; background-color:#0c5ba1;  color: white;">MONTO TOTAL</th>';
            $html.='         </tr>';
            $html.='     </thead>';
            $html.='     <tbody>';


            $tipoa = 0;
            $tipob = 0;
            $tipoc = 0;

            foreach ($operativos as $operativo)
            {
                foreach($operativo->actas as $acta)
                {
                    foreach($acta->pagos as $pago)
                    {
                            if($pago->tipo == "SANCION")
                            {
                                $tipoa+=$pago->monto;
                            }
                            else if($pago->tipo == "INFRACCION")
                            {    
                                $tipob+=$pago->monto;
                            }
                            else
                            {
                                $tipoc+=$pago->monto;
                            }
                    }
                }
            }

            $html.='<tr>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR MULTAS (ACTAS DE CONTROL)</td>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$tipob.'</td>';
            $html.='</tr>';

            $html.='<tr>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR MULTAS DE RESOLUCIÓN DE SANCIÓN</td>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$tipoa.'</td>';
            $html.='</tr>';


            $html.='<tr>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">MONTOS RECAUDADOS POR DERECHOS DE TRÁMITES</td>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.$tipoc.'</td>';
            $html.='</tr>';

            $html.='<tr>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">TOTAL</td>';
                $html.='                 <td style="border: 1px solid #ccc; padding: 8px;">'.($tipoc + $tipoa + $tipob).'</td>';
            $html.='</tr>';
        
            $html.='     </tbody>';
            $html.=' </table>';

            
            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
                    
            //Establecer el tamaño de hoja en DOMPDF
            $dompdf->setPaper('A4', 'portrait');
            
            // Renderizar el PDF
            $dompdf->render();
            
            // Forzar descarga del PDF
            $dompdf->stream("REPORTEDEPAGOS.pdf", [ "Attachment" => true]);

            return redirect()->back();   
        }
    } 

}
