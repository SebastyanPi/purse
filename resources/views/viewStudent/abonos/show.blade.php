@extends('dash.app')
@section('content')
    <x-abono-receipts :content="json_decode($content)" ></x-abono-receipts>
@endsection