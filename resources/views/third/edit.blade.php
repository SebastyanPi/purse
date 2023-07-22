@extends('dash.app')
@section('content')

<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12 mb-4">
            <a href="{{ route('third.entry') }}" class="btn-dark btn-sm"><i class="fa-solid fa-left-long mr-2"></i> Agregar</a>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fa-solid fa-business-time mr-2"></i>Editar Tercero</h4>
                </div>
                <div class="card-body">
                    <div id="msgError" class="d-none">
                        <div class="alert alert-danger mt-2">
                            <ul id="msgErrorList">
                                <li>- La <b>cedula</b> es Obligaria</li>
                                <li>- El <b>nombre</b> es Obligatorio</li>
                            </ul>
                        </div>
                      </div>
                    <form id="addThirdEntry" method="POST"  action="{{ route('third.entry.update',$third->id) }}">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputEmail1">Cedula o Nit <small class="text-danger">(Obligatorio)</small></label>
                          <input type="number" value="{{ $third->cedula }}" name="cedula" id="cedula" class="form-control form-control-sm number-lg" id="exampleInputEmail1"  placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Nombre y apellido <small class="text-danger">(Obligatorio)</small></label>
                          <input type="text" value="{{ $third->nombre }}" name="nombre" id="nombre" class="form-control form-control-sm number-lg" id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Dirección </label>
                            <input type="text" value="{{ $third->direccion }}" name="direccion" id="direccion" class="form-control form-control-sm number-lg" id="exampleInputPassword1" placeholder="">
                          </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Telefono</label>
                            <input type="number" value="{{ $third->telefono }}" name="telefono" id="telefono" class="form-control form-control-sm number-lg" id="exampleInputPassword1" placeholder="">
                          </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Actividad <small class="text-primary bg-small-modal"><a data-toggle="modal" data-target="#exampleModal">(Agregar)</a></small><small class="text-warning bg-small-modal"><a data-toggle="modal" data-target="#editModalActivity">(Editar)</a></small></label>
                            <select id="inputState" name="actividad" id="actividad" class="form-control form-control-sm number-lg">
                                @foreach ($thirdActivity as $item)
                                    <option @if ($third->actividad == $item->id) Selected @endif value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Mas descripción</label>
                            <textarea name="mas" id="mas" class="form-control form-control-sm number-lg" name="" id="" cols="30" rows="10">{{ $third->mas }}</textarea>
                          </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-hand-pointer mr-2"></i>Editar</button>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('thirdEntry.table')
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="editModalActivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Actividades</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach ($thirdActivity as $item)
            <form action="{{ route('third.activity.update',$item->id)}}" class="mt-2" method="POST">
              @csrf
              <div class="row">
                <div class="col-md-8">
                  <input type="text" name="nombre" class="form-control form-control-sm number-lg" value="{{ $item->nombre }}">
                </div>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                </div>
              </div>
  
            </form>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btnClose" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Actividad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="msgError1" class="d-none">
            <div class="alert alert-danger mt-2">
                <ul id="msgErrorList1">
                    <li>- La <b>cedula</b> es Obligaria</li>
                    <li>- El <b>nombre</b> es Obligatorio</li>
                </ul>
            </div>
          </div>
            <form id="formAddThirdActivity" method="POST" action="{{ route('third.activity.add') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre de la Actividad</label>
                  <input type="text" id="nombre" name="nombre" class="form-control form-control-sm number-lg">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Agregar</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btnClose" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('page')
    @php
        echo "Ingreso de Terceros";
    @endphp
@endsection