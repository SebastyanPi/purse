<?php

namespace App\Http\Controllers;
use App\Models\consecutive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OtherEntry;
use App\Http\Controllers\MoneyController;
use App\Http\Requests\OtherEntryRequest;
use Dompdf\Dompdf;
use App\Models\table_change;
use App\Models\Cost;
use App\Http\Controllers\TableChangeController;

class OtherEntryController extends Controller
{
    //

    public static function getOtherEntry($id,$conPuntos){
        $OtherEntries = DB::connection('mysql')->select('SELECT other_entries.id, other_entries.id_cost, otros_conceptos.nombre AS concepto, other_entries.descripcion, other_entries.no_recibo, other_entries.fecha_recibo, other_entries.valor,elaborados.nombre AS elaborado_por, CONCAT(debes.cuenta, " - ", debes.nombre) AS debe , CONCAT(habers.cuenta, " - ", habers.nombre) AS haber, other_entries.created_at FROM other_entries INNER JOIN costs ON costs.id = other_entries.id_cost INNER JOIN otros_conceptos ON otros_conceptos.id = other_entries.concepto INNER JOIN elaborados ON elaborados.id = other_entries.elaborado_por INNER JOIN debes ON debes.id = other_entries.debe INNER JOIN habers ON habers.id = other_entries.haber WHERE costs.cod_alumno ="'.$id.'" ORDER BY other_entries.no_recibo ASC');
        if($conPuntos){
            for ($i=0; $i < count($OtherEntries); $i++) { 
                $OtherEntries[$i] = MoneyController::datas($OtherEntries[$i],['valor']);
            }
        }
        return $OtherEntries;
    }

    public function all(Request $request){
        //$all = Entry::where('id_cost',$request->id)->get();
        $all = DB::connection('mysql')->select('SELECT other_entries.id, other_entries.id_cost, otros_conceptos.nombre AS concepto, other_entries.descripcion, other_entries.no_recibo, other_entries.fecha_recibo, other_entries.valor,elaborados.nombre AS elaborado_por, CONCAT(debes.cuenta, " - ", debes.nombre) AS debe , CONCAT(habers.cuenta, " - ", habers.nombre) AS haber, other_entries.created_at FROM other_entries INNER JOIN otros_conceptos ON otros_conceptos.id = other_entries.concepto INNER JOIN elaborados ON elaborados.id = other_entries.elaborado_por INNER JOIN debes ON debes.id = other_entries.debe INNER JOIN habers ON habers.id = other_entries.haber WHERE other_entries.id_cost ="'.$request->id.'" ORDER BY other_entries.no_recibo ASC');
        echo json_encode($all);
    }

    public function store(OtherEntryRequest $request){
        $con = consecutive::where('type','entry')->first();
        $sql = OtherEntry::create([
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
        //table_change::create(['table' => 'other_entries','id_change' => $sql->id, 'add' => 1,'edit' => 0, 'delete' => 0]);
        TableChangeController::StoreAdd('other_entries',$sql->id);
        if($request->no_recibo != "" && $request->no_recibo >= $con->num_start){
            $new_current = intval($request->no_recibo)+1;
            $modificacion = DB::connection('mysql')->select('UPDATE consecutives SET num_current = "'.$new_current.'" WHERE id = "1"');
            //table_change::create(['table' => 'consecutives','id_change' => '1', 'add' => 0,'edit' => 1, 'delete' => 0]);
            TableChangeController::StoreEdit('consecutives',1);
        }
        //return redirect()->route('student.view',$request->cod_alumno)->with('success','Otro Abono #'.$request->no_recibo.' agregado Correctamente');
        echo 'OK';
    }

    public function update(OtherEntryRequest $request,$id){
        $entry = OtherEntry::where('id',$id)->first();
        $entry->concepto = $request->concepto;
        $entry->descripcion = $request->descripcion;
        $entry->fecha_recibo = $request->fecha_recibo;
        $entry->valor = $request->valor;
        $entry->elaborado_por = $request->elaborado_por;
        $entry->debe = $request->debe;
        $entry->haber = $request->haber;
        $entry->save();
        TableChangeController::StoreEdit('other_entries',$entry->id);
        return view('viewStudent.close');
    }

    public function show($id){
        $i = OtherEntry::where('no_recibo',$id)->count();
        if($i > 0){
            $item = OtherEntry::where('no_recibo',$id)->first();
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
            
            return view('viewStudent.otrosAbonos.show')->with('content', json_encode($struct));
        }else{
            return redirect()->route('otros.abonos');
        }
    }

    public function destroy($id){
        $entry = OtherEntry::where('id',$id)->first();
        $entry->delete();
        //table_change::create(['table' => 'other_entries','id_change' => $entry->id, 'add' => 0,'edit' => 0, 'delete' => 0]);
        TableChangeController::StoreDelete('other_entries',$entry->id);
        return view('viewStudent.close');
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
        $dompdf->loadHtml(view('PDFs.pdf_otrosAbonos',[ 'id_cost' => $id, 'student' => $data]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('informe-otros-abonos-'.$data[0]->nombre.'.pdf');

        //return view('PDFs.pdf_abonos',[ 'id_cost' => $id, 'student' => $data]);
    }
    
       
}
