<?php

namespace App\Http\Controllers;
use App\Models\ThirdReceipts;
use App\Models\consecutive;
use Illuminate\Http\Request;

class ThirdReceiptsController extends Controller
{
    //

    public function store(Request $request){

        if(isset($request->id) && $request->id != null){

            $receipt = ThirdReceipts::where('id', $request->id)->first();
            $receipt->third = $request->third;
            $receipt->concepto = $request->concepto;
            $receipt->detalles = $request->detalles;
            $receipt->valor = str_replace(".","",$request->valor);
            $receipt->debe = $request->debe;
            $receipt->haber = $request->haber;
            $receipt->elaborado_por = $request->elaborado_por;
            $receipt->forma = $request->forma;
            $receipt->save();
            return redirect()->route('third.receipts.'.$request->type.'.edit', $receipt->no_recibo)->with('success','Recibo guardado Correctamente');

        }else{
            $receipt = ThirdReceipts::create([
                'no_recibo' => $request->no_recibo,
                'type' => $request->type,
                'third' => $request->third,
                'concepto' => $request->concepto,
                'detalles' => $request->detalles,
                'valor' => str_replace(".","",$request->valor),
                'debe' => $request->debe,
                'haber' => $request->haber,
                'elaborado_por' => $request->elaborado_por,
                'forma' => $request->forma
            ]);
    
            $con = consecutive::where('type',$request->type)->first();
            $con->num_current = intval($con->num_current) + 1;
            $con->save();
    
            return redirect()->route('third.receipts.'.$request->type)->with('success','Recibo realizado Correctamente');
        }
    }

    public function redireccionarEntry($id){
        $count = ThirdReceipts::where('no_recibo', $id)->count();
        if($count == 0){
            return redirect()->route('third.receipts.entry');
        }else{
            $content = ThirdReceipts::where('no_recibo', $id)->where('type', 'entry')->first()->load('thirdObject','debeObject', 'haberObject', 'elaboradoObject');
            return view('third.thirdEntryReceiptsEdit', ['id' => $id , 'content' => $content]);
        }
    }

    public function redireccionarDischarge($id){
        $count = ThirdReceipts::where('no_recibo', $id)->count();
        
        if($count == 0){
            return redirect()->route('third.receipts.discharge');
        }else{
            $content = ThirdReceipts::where('no_recibo', $id)->where('type', 'discharge')->first()->load('thirdObject','debeObject', 'haberObject', 'elaboradoObject');
            return view('third.thirdDischargeReceiptsEdit', ['id' => $id , 'content' => $content]);
        }
        
    }
}
