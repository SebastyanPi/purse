<?php

namespace App\Http\Controllers;
use App\Models\thirdEntry;
use App\Models\haber;
use App\Models\debe;
use App\Models\consecutive;
use App\Models\thirdActivity;
use Illuminate\Http\Request;

class thirdEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listActivity = thirdActivity::orderBy('created_at', 'desc')->get();
        $list = thirdEntry::orderBy('created_at', 'desc')->get();
        $haber = haber::all();
        $debe = debe::all();
        $con = consecutive::where('type','entry')->first();
        
        return view('third.home', ['thirdEntry' => $list->load('thirdActivity'),        
        'haber' => $haber, 
        'debe' => $debe, 
        'thirdActivity' => $listActivity,
        'consecutive' => $con ]);

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
    public function store(Request $request)
    {
        $third = thirdEntry::create($request->all());
        return redirect()->route('third.entry')->with('success','Agregado Correctamente');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listActivity = thirdActivity::orderBy('created_at', 'desc')->get();
        $list = thirdEntry::orderBy('created_at', 'desc')->get();
        $item = thirdEntry::where('id', $id)->first();

        return view('third.edit', ['thirdEntry' => $list->load('thirdActivity'), 
        'third' => $item, 
        'thirdActivity' => $listActivity]);
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
        $item = thirdEntry::where('id', $id)->first();
        $item->cedula = $request->cedula;
        $item->nombre = $request->nombre;
        $item->direccion = $request->direccion;
        $item->telefono = $request->telefono;
        $item->actividad = $request->actividad;
        $item->mas = $request->mas;
        $item->save();
        return redirect()->route('third.entry')->with('success','Editado Correctamente');
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

    public function search($name){
        $list = thirdEntry::where('nombre', 'like', '%'.$name.'%')->get();
        return json_encode($list);
    }
}
