<?php

namespace App\Http\Controllers;
use App\Models\concepto;
use App\Models\elaborado;
use App\Models\haber;
use App\Models\debe;
use App\Models\otrosConcepto;
use App\Http\Requests\ConceptoRequest;
use App\Http\Requests\ElaboradoRequest;
use App\Http\Requests\DebeRequest;
use App\Http\Requests\HaberRequest;
use App\Http\Requests\OtrosConceptosRequest;
use Illuminate\Http\Request;
use App\Models\table_change;
use App\Http\Controllers\TableChangeController;
use function GuzzleHttp\Promise\all;

class SettingController extends Controller
{
    //

    public function index(){
        $conceptos = concepto::all();
        $sql = concepto::where('orderTable','1')->count();
        $elaborado = elaborado::all();
        $haber = haber::all();
        $debe = debe::all();
        $otros = otrosConcepto::all();
        return view('setting.index',['otros' => $otros,'conceptos' => $conceptos,'count' => $sql,'elaborados'=> $elaborado, 'haber' =>$haber, 'debe' => $debe ]);
    
    
    }

    public function StoreConcepto(ConceptoRequest $request){
        if($request->id != ""){
            $con = concepto::where('id',$request->id)->first();
            $con->nombre = $request->nombre;
            $con->estado = $request->estado;
            $con->orderTable = $request->orderTable;
            $con->consecutivo = $request->consecutivo;
            $con->save();
            TableChangeController::StoreEdit('conceptos',$con->id);
        }else{
            $sql = concepto::create($request->all());
            if($sql){
                TableChangeController::StoreAdd('conceptos',$sql->id);
            }
            
        }
        return redirect()->route('setting.index')->with('success','Guardado Correctamente');
    }
    public function StoreOtrosConcepto(OtrosConceptosRequest $request){
        if($request->id != ""){
            $con = otrosConcepto::where('id',$request->id)->first();
            $con->nombre = $request->nombre;
            $con->estado = $request->estado;
            $con->save();
            TableChangeController::StoreEdit('otros_conceptos',$con->id);
        }else{
            $sql = otrosConcepto::create($request->all());
            TableChangeController::StoreAdd('otros_conceptos',$sql->id);
        }
        return redirect()->route('setting.index')->with('success','Guardado Correctamente');
    }
    public function StoreElaborado(ElaboradoRequest $request){
        if($request->id != ""){
            $ela = elaborado::where('id',$request->id)->first();
            $ela->nombre = $request->nombre;
            $ela->estado = $request->estado;
            $ela->save();
            TableChangeController::StoreEdit('elaborados',$ela->id);
        }else{
            $sql = elaborado::create($request->all());
            TableChangeController::StoreAdd('elaborados',$sql->id);
        }
        return redirect()->route('setting.index')->with('success','Guardado Correctamente');
    }
    public function StoreHaber(HaberRequest $request){
        if($request->id != ""){
            $haber = haber::where('id',$request->id)->first();
            $haber->cuenta = $request->cuenta;
            $haber->nombre = $request->nombre;
            $haber->save();
            TableChangeController::StoreEdit('habers',$haber->id);
        }else{
            $sql = haber::create($request->all());
            TableChangeController::StoreAdd('habers',$sql->id);
        }
        return redirect()->route('setting.index')->with('success','Guardado Correctamente');
    }
    public function StoreDebe(DebeRequest $request){
        if($request->id != ""){
            $debe = debe::where('id',$request->id)->first();
            $debe->cuenta = $request->cuenta;
            $debe->nombre = $request->nombre;
            $debe->save();
            TableChangeController::StoreEdit('debes',$debe->id);
        }else{
            $sql = debe::create($request->all());
            TableChangeController::StoreAdd('debes',$sql->id);
        }
        return redirect()->route('setting.index')->with('success','Guardado Correctamente');
    }

    
}
