<?php

namespace App\Http\Controllers;
use App\Models\Entry;
use App\Models\Purse;
use App\Models\historyPurse;
use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\consecutive;
use App\Http\Requests\EntryRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\DateController;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use App\Models\table_change;
use App\Http\Controllers\TableChangeController;
use Dompdf\Dompdf;


class EntryController extends Controller
{
  
    public static function getEntry($id,$conPuntos){
        $Entries = DB::connection('mysql')->select('SELECT entries.id, entries.id_cost, conceptos.nombre AS concepto, entries.descripcion, entries.no_recibo, entries.fecha_recibo, entries.valor,elaborados.nombre AS elaborado_por, CONCAT(debes.cuenta, " - ", debes.nombre) AS debe , CONCAT(habers.cuenta, " - ", habers.nombre) AS haber, entries.created_at FROM entries INNER JOIN costs ON costs.id = entries.id_cost INNER JOIN conceptos ON conceptos.id = entries.concepto INNER JOIN elaborados ON elaborados.id = entries.elaborado_por INNER JOIN debes ON debes.id = entries.debe INNER JOIN habers ON habers.id = entries.haber WHERE costs.cod_alumno ="'.$id.'" ORDER BY entries.no_recibo ASC');
        if($conPuntos){
            for ($i=0; $i < count($Entries); $i++) { 
                $Entries[$i] = MoneyController::datas($Entries[$i],['valor']);
            }
        }
        return $Entries;
    }

    public function all(Request $request){
        //$all = Entry::where('id_cost',$request->id)->get();
        $all = DB::connection('mysql')->select('SELECT entries.id, entries.id_cost, conceptos.nombre AS concepto, entries.descripcion, entries.no_recibo, entries.fecha_recibo, entries.valor,elaborados.nombre AS elaborado_por, CONCAT(debes.cuenta, " - ", debes.nombre) AS debe , CONCAT(habers.cuenta, " - ", habers.nombre) AS haber, entries.created_at FROM entries INNER JOIN conceptos ON conceptos.id = entries.concepto INNER JOIN elaborados ON elaborados.id = entries.elaborado_por INNER JOIN debes ON debes.id = entries.debe INNER JOIN habers ON habers.id = entries.haber WHERE entries.id_cost ="'.$request->id.'" ORDER BY entries.no_recibo ASC');
        echo json_encode($all);
    }

    public function show($id){
        $i = Entry::where('no_recibo',$id)->count();
        if($i > 0){
            $item = Entry::where('no_recibo',$id)->first();
            $infoCost = Cost::where('id', $item->id_cost)->first();
            $alumno = DB::connection('mysql2')->select('SELECT nombre FROM alumno WHERE cod_alumno = "'.$infoCost->cod_alumno.'"');

            $struct = [
                "id" => $item->id,
                "id_cost" => $item->id_cost,
                "cod_alumno" => $infoCost->cod_alumno,
                "nombre" => $alumno[0]->nombre,
                "concepto" => $item->concepto,
                "descripcion" => $item->descripcion,
                "no_recibo" => $item->no_recibo,
                "fecha_recibo" => $item->fecha_recibo,
                "valor" => $item->valor,
                "elaborado_por" => $item->elaborado_por,
                "debe" => $item->debe,
                "haber" => $item->haber,
                "forma" => $item->forma
            ];
            
            return view('viewStudent.abonos.show')->with('content', json_encode($struct));
        }else{
            return redirect()->route('abonos');
        }
    }

    public function store(EntryRequest $request){
        $con = consecutive::where('type','entry')->first();
        if($request->concepto == 1){
            $is_Entry = Entry::create([
                'id_cost' => $request->id_cost,
                'concepto' => $request->concepto,
                'descripcion' => $request->descripcion,
                'no_recibo' => $request->no_recibo,
                'fecha_recibo' => $request->fecha_recibo,
                'valor' => str_replace(".","",$request->valor),
                'elaborado_por' => $request->elaborado_por,
                'debe' => $request->debe,
                'haber' => $request->haber,
                'forma' => $request->forma
            ]);
        }
        if($request->concepto == 2){
            $is_Entry = Entry::create([
                'id_cost' => $request->id_cost,
                'concepto' => $request->concepto,
                'descripcion' => $request->descripcion,
                'fecha_recibo' => $request->fecha_recibo,
                'valor' => str_replace(".","",$request->valor),
                'elaborado_por' => $request->elaborado_por,
                'debe' => $request->debe,
                'haber' => $request->haber,
                'forma' => $request->forma
            ]);
        }
        
        if($request->concepto != 2 && $request->no_recibo != "" && $request->no_recibo >= $con->num_start){
            $new_current = intval($request->no_recibo)+1;
            $modificacion = DB::connection('mysql')->select('UPDATE consecutives SET num_current = "'.$new_current.'" WHERE id = "1"');
            //table_change::create(['table' => 'consecutives','id_change' => '1', 'add' => 0,'edit' => 1, 'delete' => 0]);
            TableChangeController::StoreEdit('consecutives',1);
        }
        if($is_Entry){
            //table_change::create(['table' => 'entries','id_change' => $is_Entry->id, 'add' => 1,'edit' => 0, 'delete' => 0]);
            TableChangeController::StoreAdd('entries',$is_Entry->id);
            $arrayCost = DB::table('costs')->where('id',$request->id_cost)->first();
            $rowsPurses = DB::table('purses')->where('id_cost',$request->id_cost)->count();
            if($rowsPurses == 0){
                $fechaActual = explode("-",$arrayCost->fecha_pago);
                $Mes = $fechaActual[1];
                $nameMes = DateController::getMes($Mes);
                $Año = $fechaActual[0]; 
                for ($i=0; $i < $arrayCost->numero_cuotas ; $i++) { 
                    if($i > 0){
                        $Mes = DateController::nextMes($Mes,true);
                        $Año = DateController::Is_nextYear($Año,$Mes);
                        $nameMes = DateController::getMes($Mes);
                    }
                    if($Mes < 10 && strlen($Mes) == 1){
                        $Mes = "0".$Mes;
                    }
                    
                    $obj = Purse::create([
                        'id_cost' => $request->id_cost,
                        'fecha_pago' => $Año."-".$Mes."-".$fechaActual[2],
                        'estado' => 'Pendiente',
                        'cuota' => $arrayCost->valor_cuotas,
                        'abonado' => 0,
                        'comentario' => 'Fecha de pago establecidas con sus cuotas iniciales.'
                    ]);
                    if($obj){
                        //table_change::create(['table' => 'purses','id_change' => $obj->id, 'add' => 1,'edit' => 0, 'delete' => 0]);
                        TableChangeController::StoreAdd('purses',$obj->id);
                        $obj1 = historyPurse::create([
                            'id_purse' => $obj->id,
                            'fecha_pago'=> $obj->fecha_pago,
                            'estado'=> $obj->estado,
                            'cuota'=> $obj->cuota,
                            'abonado'=> $obj->abonado,
                            'comentario'=> $obj->comentario
                        ]);
                        if($obj1){
                            TableChangeController::StoreAdd('history_purses',$obj1->id);
                            //table_change::create(['table' => 'history_purses','id_change' => $obj1->id, 'add' => 1,'edit' => 0, 'delete' => 0]);
                        }
                    }
                    
                }
            }
        }
        echo 'OK';
        //return redirect()->route('student.view',$request->cod_alumno)->with('success','Abono #'.$request->no_recibo.' agregado Correctamente');
    }

    public function update(EntryRequest $request,$id){
        $entry = Entry::where('id',$id)->first();
        $entry->concepto = $request->concepto;
        $entry->descripcion = $request->descripcion;
        $entry->fecha_recibo = $request->fecha_recibo;
        $entry->valor = $request->valor;
        $entry->no_recibo = $request->no_recibo;
        $entry->elaborado_por = $request->elaborado_por;
        $entry->debe = $request->debe;
        $entry->haber = $request->haber;
        $entry->save();
        TableChangeController::StoreEdit('entries',$entry->id);
        $con = consecutive::where('type','entry')->first();
        if($request->no_recibo == $con->num_current){
            $new_current = intval($request->no_recibo)+1;
            $modificacion = DB::connection('mysql')->select('UPDATE consecutives SET num_current = "'.$new_current.'" WHERE id = "1"');
            TableChangeController::StoreEdit('consecutives',1);
        }
        return view('viewStudent.close');
    }

    public function destroy($id){
        $entry = Entry::where('id',$id)->first();
        $entry->delete();
        TableChangeController::StoreDelete('entries',$entry->id);
        return view('viewStudent.close');
    }


    public function print($id){
        $entry = Entry::where('id',$id)->first();
        $concepto =  DB::connection('mysql')->select('SELECT * FROM conceptos WHERE id = "'.$entry->concepto.'"');
        $sqlCodAlumno = DB::connection('mysql')->select('SELECT costs.cod_alumno FROM `entries` INNER JOIN costs ON costs.id = entries.id_cost WHERE entries.id = "'.$id.'"');
        $sqlAlumno = DB::connection('mysql2')->select('SELECT alumno.nombre, alumno.cedula, programa.nombre_programa FROM `alumno` INNER JOIN relacion_programa_estudiante ON relacion_programa_estudiante.Alumno_cod = alumno.cod_alumno INNER JOIN programa ON programa.cod_programa = relacion_programa_estudiante.programa_cod WHERE alumno.cod_alumno = "'.$sqlCodAlumno[0]->cod_alumno.'"');
        
        
        $connector = new WindowsPrintConnector("TM-U220I");
        $printer = new Printer($connector);
        # Vamos a alinear al centro lo próximo que imprimamos
        //$printer->setJustification(Printer::JUSTIFY_CENTER);
        /* Intentaremos cargar e imprimir el logo*/
        //$logo = EscposImage::load("dimages/chart.png");
        //$printer->bitImageColumnFormat($logo);
        //$printer->setTextSize(8,8);
        //$printer->setEmphasis(true);
        $printer->text("----------------------------------------");
        $printer->text("\n");
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("INSTITUTO TECNICO DEL SABER\n");
        //$printer->selectPrintMode(Printer::MODE_UNDERLINE);  
        $printer->text("Sede Barrancabermeja\n");
        $printer->text("Calle 51 #16-66 B.Colombia \n");
        //$printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setEmphasis(true);
        $printer->text("----------------------------------------");
        $printer->text("REGISTRO DE INGRESOS\n");
        $printer->text("----------------------------------------\n\n");
        $printer->setEmphasis(false);
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        /*$printer->setEmphasis(true);
        $printer->text("Identidad de Pago\n");
        $printer->setEmphasis(false);
        $printer->text($entry->id."\n\n");*/
        $printer->setEmphasis(true);
        $printer->text("C.C del Alumno(a)\n");
        $printer->setEmphasis(false);
        $printer->text($sqlAlumno[0]->cedula."\n\n");
        $printer->setEmphasis(true);
        $printer->text("Estudiante\n");
        $printer->setEmphasis(false);
        $printer->text(strtoupper($sqlAlumno[0]->nombre)."\n\n");
        $printer->setEmphasis(true);
        $printer->text("Programa\n");
        $printer->setEmphasis(false);
        $printer->text(strtoupper($sqlAlumno[0]->nombre_programa)."\n\n");
        $printer->setEmphasis(true);
        $printer->text("Concepto\n");
        $printer->setEmphasis(false);
        $printer->text($concepto[0]->nombre."\n\n");
        $printer->setEmphasis(true);
        $printer->text("Descripción\n");
        $printer->text($entry->descripcion."\n\n");
        $printer->text("----------------------------------------");
        $printer->text("No Recibo : ".$entry->no_recibo."\n");
        $printer->text("----------------------------------------");
        $printer->text("Fecha de Recibo : ".$entry->fecha_recibo."\n");
        $printer->text("----------------------------------------");
        $printer->text("Valor : $".$entry->valor."\n");
        $printer->text("----------------------------------------");
        $printer->setTextSize(1,1);
        $printer->selectPrintMode(Printer::MODE_UNDERLINE);
        $printer->setEmphasis(false);
        $printer->text("\n");
        $printer->selectPrintMode(Printer::MODE_FONT_A);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->feed();
        $printer->text("Muchas gracias por la confianza  depositada en nuestra institución.");
        $printer->text("\n");
        $printer->cut();
        $printer->close();
        echo "Imprimiendo..";
    }


    public function ViewPdf($id){
        $arrayCost = DB::table('costs')->where('id',$id)->first();
        $data = DB::connection('mysql2')->SELECT('SELECT alumno.cedula , alumno.nombre, programa.nombre_programa FROM alumno INNER JOIN relacion_programa_estudiante ON relacion_programa_estudiante.Alumno_cod = alumno.cod_alumno INNER JOIN programa ON programa.cod_programa = relacion_programa_estudiante.programa_cod WHERE alumno.cod_alumno = "'.$arrayCost->cod_alumno.'"');
        /*$mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $html = View::make('PDFs.pdf_abonos')->with([ 'id_cost' => $id, 'student' => $data]);
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Lista.pdf','I');*/

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('PDFs.pdf_abonos',[ 'id_cost' => $id, 'student' => $data]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('informe-abonos-'.$data[0]->nombre.'.pdf');

        //return view('PDFs.pdf_abonos',[ 'id_cost' => $id, 'student' => $data]);
    }

    public function ViewPdfUnitedOther($id){
        $arrayCost = DB::table('costs')->where('id',$id)->first();
        $data = DB::connection('mysql2')->SELECT('SELECT alumno.cedula , alumno.nombre, programa.nombre_programa FROM alumno INNER JOIN relacion_programa_estudiante ON relacion_programa_estudiante.Alumno_cod = alumno.cod_alumno INNER JOIN programa ON programa.cod_programa = relacion_programa_estudiante.programa_cod WHERE alumno.cod_alumno = "'.$arrayCost->cod_alumno.'"');
        /*$mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 15,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $html = View::make('PDFs.pdf_abonos')->with([ 'id_cost' => $id, 'student' => $data]);
        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output('Lista.pdf','I');*/

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('PDFs.pdf_abonosUother',[ 'id_cost' => $id, 'student' => $data]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('informe-abonosYotros-'.$data[0]->nombre.'.pdf');

        //return view('PDFs.pdf_abonos',[ 'id_cost' => $id, 'student' => $data]);
    }      

    
}
