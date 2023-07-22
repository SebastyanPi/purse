@extends('layouts.pdf')

@section('content')
    @php
        date_default_timezone_set("America/Bogota");
    @endphp
    <div class="container text-center">
        <h2 style="text-align: center;font-family: Arial, Helvetica, sans-serif;margin-bottom:20px;">
            <i class="fa-solid fa-sack-dollar mr-2" ></i>OTROS ABONOS
        </h2>

    </div>

    <div class="d-flex p-2 my-4" style="background-color: #e7e9eb ;padding:10px;font-family: Arial, Helvetica, sans-serif;">
        <div class="mr-3 text-black">
            Cedula : <b>{{ $student[0]->cedula }}</b>
        </div>
        <div class="mr-3 text-black">
            Estudiante : <b>{{ $student[0]->nombre }} </b>
        </div>
        <div class="mr-3 text-black">
            Programa : <b>{{ $student[0]->nombre_programa }}</b>
        </div>
    </div>
    <br>
    @livewire('purses.otros-ingresos', ['id_cost' => $id_cost])
    
@endsection
