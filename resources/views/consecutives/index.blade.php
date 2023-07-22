@extends('dash.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="fa-solid fa-triangle-exclamation text-danger mr-2"></i> Errores</h4>
            </div>
            <div class="card-body">
                <div class="basic-list-group">
                    <ul class="list-group">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item"><i class="fa-solid fa-circle-exclamation text-danger mr-2"></i><small>{{ $error }}</small></li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    @endif

<form method="POST" action="{{ route('consecutive.store') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            <span class="text-primary"><b><i class="fa-solid fa-scroll mr-2"></i> Consecutivos de Ingresos</b></span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                        <div class="row mb-2">
                            <input type="hidden" name="type"  value="entry">
                            <div class="col-sm-4">
                                <label for=""><i class="fa-solid fa-arrow-right mr-2"></i>Inicio</label>
                                <input type="text" name="num_start" value="{{ $entry->num_start }}" class="form-control form-control-sm number-lg" >
                            </div>
                            <div class="col-sm-4">
                                <label for=""><i class="fa-solid fa-arrow-down-long mr-2"></i>Actual</label>
                                <input type="text" name="num_current" value="{{ $entry->num_current }}" class="form-control form-control-sm number-lg" readonly>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<hr>

<form method="POST" action="{{ route('consecutive.store') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            <span class="text-primary"><b><i class="fa-solid fa-scroll mr-2"></i> Consecutivos de Egresos</b></span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                        <div class="row mb-2">
                            <input type="hidden" name="type"  value="discharge">
                            <div class="col-sm-4">
                                <label for=""><i class="fa-solid fa-arrow-right mr-2"></i>Inicio</label>
                                <input type="text" name="num_start" value="{{ $discharge->num_start }}" class="form-control form-control-sm number-lg" >
                            </div>
                            <div class="col-sm-4">
                                <label for=""><i class="fa-solid fa-arrow-down-long mr-2"></i>Actual</label>
                                <input type="text" name="num_current" value="{{ $discharge->num_current }}" class="form-control form-control-sm number-lg" readonly>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection