@extends('dash.app')
@section('content')
    <x-otros-abonos :content="json_decode($content)" ></x-otros-abonos>
@endsection