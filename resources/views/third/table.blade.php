@php 
$head = [
    [
        "Columna" => "Cedula",
        "Origen" => "cedula",
        "EsEnlace" => true,
        "Ruta" => [
            "Nombre" => "third.entry.edit",
            "Parametro" => "id"
        ],
        "EsVacio" => false,
    ],
    [
        "Columna" => "Nombre",
        "Origen" => "nombre",
        "EsEnlace" => false,
        "EsVacio" => false,
    ],
    [
        "Columna" => "Telefono",
        "Origen" => "telefono",
        "EsEnlace" => false,
        "EsVacio" => false,
    ]
]; 
@endphp
<x-table :thead="json_encode($head)" :tbody="$thirdEntry" />