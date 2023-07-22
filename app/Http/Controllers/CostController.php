<?php

namespace App\Http\Controllers;
use App\Http\Requests\CostRequest;
use App\Models\Cost;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\consecutive;
use App\Models\table_change;
use App\Http\Controllers\TableChangeController;
use App\Http\Controllers\DateController;
use App\Models\Purse;
use App\Models\historyPurse;
use App\Http\Controllers\MoneyController;

class CostController extends Controller
{

    private $tableChange;
    //
    public function construct()
    {
        $this->tableChange = new TableChangeController();
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CostRequest $request)
    {
        $message = '';
        $Cost = Cost::where('cod_alumno',$request->cod_alumno)->first();
        $this->construct();
        if(empty($Cost) == true){
            $cost1 = Cost::create($request->all());
            $message = "Añadido Correctamente";
            TableChangeController::StoreAdd('costs',$cost1->id);

            $arrayCost = DB::table('costs')->where('id',$cost1->id)->first();
            $rowsPurses = DB::table('purses')->where('id_cost',$arrayCost->id)->count();
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
                        'id_cost' => $arrayCost->id,
                        'fecha_pago' => $Año."-".$Mes."-".$fechaActual[2],
                        'estado' => 'Pendiente',
                        'cuota' => $arrayCost->valor_cuotas,
                        'abonado' => 0,
                        'comentario' => 'Fecha de pago establecidas con sus cuotas iniciales.'
                    ]);
                    /*if($obj){
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
                    }*/
                    
                }
            }
            
        }else{
            $Cost->valor_semestre = $request->valor_semestre;
            $Cost->numero_semestre = $request->numero_semestre;
            $Cost->valor_total_semestre = $request->valor_total_semestre;
            $Cost->descuento = $request->descuento;
            $Cost->valor_neto = $request->valor_neto;
            $Cost->saldo_financiar = $request->saldo_financiar;
            $Cost->periodo = $request->periodo;
            $Cost->numero_cuotas = $request->numero_cuotas;
            $Cost->valor_cuotas = $request->valor_cuotas;
            $Cost->fecha_pago = $request->fecha_pago;
            $Cost->detalles = $request->detalles;
            $Cost->save();

            $numCost = Purse::where('id_cost', $Cost->id)->count();

            if($numCost == $Cost->numero_cuotas){
                $Costs = Purse::where('id_cost', $Cost->id)->get();
                $k = 0;
                foreach ($Costs as $item) {
          
                    $item->cuota = $Cost->valor_cuotas;
                    if($k == 0){
                        $item->fecha_pago = $Cost->fecha_pago;  
                    }else{
                        $fechaActual = explode("-",$Cost->fecha_pago);
                        $Mes = $fechaActual[1];
                        $nameMes = DateController::getMes($Mes);
                        $Año = $fechaActual[0]; 
                        $Mes = DateController::nextMes($Mes,true);
                        $Año = DateController::Is_nextYear($Año,$Mes);
                        $nameMes = DateController::getMes($Mes);

                        if($Mes < 10 && strlen($Mes) == 1){
                            $Mes = "0".$Mes;
                        }

                        $item->fecha_pago = $Año."-".$Mes."-".$fechaActual[2];
                    }
                    $item->save();
                    $k++;
                }
            }else{
                $delete = Purse::where('id_cost', $Cost->id)->delete();
                $fechaActual = explode("-",$Cost->fecha_pago);
                $Mes = $fechaActual[1];
                $nameMes = DateController::getMes($Mes);
                $Año = $fechaActual[0]; 
                for ($i=0; $i < $Cost->numero_cuotas ; $i++) { 
                    if($i > 0){
                        $Mes = DateController::nextMes($Mes,true);
                        $Año = DateController::Is_nextYear($Año,$Mes);
                        $nameMes = DateController::getMes($Mes);
                    }
                    if($Mes < 10 && strlen($Mes) == 1){
                        $Mes = "0".$Mes;
                    }
                    
                    $obj = Purse::create([
                        'id_cost' => $Cost->id,
                        'fecha_pago' => $Año."-".$Mes."-".$fechaActual[2],
                        'estado' => 'Pendiente',
                        'cuota' => $Cost->valor_cuotas,
                        'abonado' => 0,
                        'comentario' => 'Fecha de pago establecidas con sus cuotas iniciales.'
                    ]);
                }
            }


            $message = "Editado Correctamente";
            //table_change::create(['table' => 'costs','id_change' => $Cost->id, 'add' => 0,'edit' => 1, 'delete' => 0]);
            TableChangeController::StoreEdit('costs',$Cost->id);

      
            
        }
        return redirect()->route('cost.show',$request->cod_alumno)->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $num = Cost::where('cod_alumno',$id)->count();
        $array = "SELECT cod_alumno, nombre FROM alumno WHERE cod_alumno = '".$id."'";
        $Student = DB::connection('mysql2')->select($array);
        if($num > 0){
            $content = Cost::where('cod_alumno',$id)->first();
            $content = [
                "id" => $content->id,
                "cod_alumno" => $content->cod_alumno,
                "valor_semestre" => MoneyController::main($content->valor_semestre),
                "numero_semestre" => $content->numero_semestre,
                "valor_total_semestre" => MoneyController::main($content->valor_total_semestre),
                "descuento" => MoneyController::main($content->descuento),
                "valor_neto" => MoneyController::main($content->valor_neto),
                "saldo_financiar" => MoneyController::main($content->saldo_financiar),
                "periodo" => $content->periodo,
                "numero_cuotas" => $content->numero_cuotas,
                "valor_cuotas" => MoneyController::main($content->valor_cuotas),
                "fecha_pago" => $content->fecha_pago,
                "detalles" => $content->detalles
            ];
        }else{
            $content = [
                "id" => "",
                "cod_alumno" => $id,
                "valor_semestre" => "",
                "numero_semestre" => "",
                "valor_total_semestre" => "",
                "descuento" => "",
                "valor_neto" => "",
                "saldo_financiar" => "",
                "periodo" => "",
                "numero_cuotas" => "",
                "valor_cuotas" => "",
                "fecha_pago" => "",
                "detalles" => "",
                "created_at" => "",
                "updated_at" => ""
            ];
        }
        return view('viewStudent.financiera.show', ['content' => json_encode($content), 'alumno' =>  json_encode($Student)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
