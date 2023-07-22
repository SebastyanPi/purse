<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\DateController;
use Illuminate\Http\Request;
use App\Models\Purse;
use Illuminate\Support\Str;
use App\Models\historyPurse;
use Illuminate\Support\Facades\DB;
use App\Models\table_change;
use App\Http\Controllers\TableChangeController;
use Dompdf\Dompdf;

class PurseController extends Controller
{
    //
    public static function getPurse($id_cost){
        $Purses = Purse::where('id_cost',$id_cost)->get();
        for ($i=0; $i < count($Purses); $i++) { 
            $Purses[$i] = MoneyController::datas($Purses[$i],['cuota','abonado']);
            $Purses[$i] = DateController::transformMonth($Purses[$i],['fecha_pago']);
        }
        return $Purses;
    } 

    public function edit(Request $request){

        //Modifico el purse
        $Purse = Purse::where('id',$request->id)->first();
        $Purse->fecha_pago = $request->fecha_pago;
        $Purse->cuota = Str::replace('.','',$request->cuota);
        $Purse->comentario = $request->comentario;
        $Purse->save();
        TableChangeController::StoreEdit('purses',$Purse->id);
        $new = historyPurse::create([
            'id_purse' => $Purse->id,
            'fecha_pago'=> $Purse->fecha_pago,
            'estado'=> $Purse->estado,
            'cuota'=> $Purse->cuota,
            'abonado'=> $Purse->abonado,
            'comentario'=> $Purse->comentario
        ]);
        if($new){
            TableChangeController::StoreAdd('history_purses',$new->id);
        }

        //Necesito modificar los demas purses

        if($request->ModifyInputLabel == "todos"){
            $ArrrayPurses =Purse::where([ ['id_cost',"=", $Purse->id_cost] , ['id',">", $Purse->id] ])->get();
            $fechaActuals = $Purse->fecha_pago;
            foreach ($ArrrayPurses as $item) {


                $fechaActual = explode("-",$fechaActuals);
                $Mes = $fechaActual[1];
                $nameMes = DateController::getMes($Mes);
                $Año = $fechaActual[0]; 
                $Año = DateController::Is_nextYear($Año,$Mes);
                $Mes = DateController::nextMes($Mes,true);
                $nameMes = DateController::getMes($Mes);
                if($Mes < 10 && strlen($Mes) == 1){
                    $Mes = "0".$Mes;
                }
                $fechaActuals = $Año."-".$Mes."-".$fechaActual[2];

                $item->fecha_pago = $fechaActuals;
                $item->cuota = Str::replace('.','',$request->cuota);
                $item->comentario = $request->comentario;
                $item->save();

                TableChangeController::StoreEdit('purses',$item->id);
                $new1 = historyPurse::create([
                    'id_purse' => $item->id,
                    'fecha_pago'=> $fechaActuals,
                    'estado'=> $item->estado,
                    'cuota'=> $item->cuota,
                    'abonado'=> $item->abonado,
                    'comentario'=> $item->comentario
                ]);

                if($new1){
                    TableChangeController::StoreAdd('history_purses',$new1->id);
                }
            }
        }
        
        echo "OK";
    }

    public function total (Request $request){
        $total = DB::connection('mysql')->select("SELECT SUM(valor) as total FROM entries WHERE id_cost = '".$request->id."'");
        echo json_encode($total);
    }

    public function ViewPdf($id){
        $arrayCost = DB::table('costs')->where('id',$id)->first();
        $data = DB::connection('mysql2')->SELECT('SELECT alumno.cedula , alumno.nombre, programa.nombre_programa FROM alumno INNER JOIN relacion_programa_estudiante ON relacion_programa_estudiante.Alumno_cod = alumno.cod_alumno INNER JOIN programa ON programa.cod_programa = relacion_programa_estudiante.programa_cod WHERE alumno.cod_alumno = "'.$arrayCost->cod_alumno.'"');
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('PDFs.pdf_cartera',[ 'id_cost' => $id, 'student' => $data]));
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream('informe-cartera-'.$data[0]->nombre.'.pdf');

    }
    
}
