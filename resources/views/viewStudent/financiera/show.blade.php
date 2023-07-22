@extends('dash.app')
@section('content')
    <x-financiera :content="json_decode($content)" :alumno="json_decode($alumno)" ></x-financiera>
@endsection