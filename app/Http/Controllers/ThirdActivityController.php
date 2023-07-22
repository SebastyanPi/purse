<?php

namespace App\Http\Controllers;
use App\Models\thirdActivity;
use Illuminate\Http\Request;

class ThirdActivityController extends Controller
{
    public function list(){
       $listActivity = thirdActivity::orderBy('created_at', 'desc')->get();
       return json_encode($listActivity);
    }

    public function store(Request $request){
        $item = thirdActivity::create($request->all());
        return redirect()->route('third.entry')->with('success','Actividad agregada Correctamente');
    }

    public function update(Request $request, $id){
        $item = thirdActivity::where('id', $id)->first();
        $item->nombre = $request->nombre;
        $item->save();
        return redirect()->route('third.entry')->with('success','Actividad editada Correctamente');
    }
}
