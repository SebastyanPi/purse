@extends('dash.app')
@section('content')

    <x-third-receipts types="entry" :content="$content" >
        <x-slot name="no_recibo">{{ $id }}</x-slot>
    </x-third-receipts>
@endsection
