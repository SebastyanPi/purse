@extends('dash.app')

@section('page')
    Otros Ajustes
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-warning alert-dismissible fade show">
    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
    <strong>Error</strong> <small>
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="fa-solid fa-circle-exclamation text-white mr-2"></i><small>{{ $error }}</small></li>
            @endforeach
        </ul>
    </small>
    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
    </button>
</div>
@endif
@if (session('success'))
            <div class="alert alert-success solid alert-dismissible fade show">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <strong>Muy bien!</strong> {{ session('success') }}
                <button type="button" class="close h-100 text-white" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close text-white"></i></span>
                </button>
            </div>
          @endif
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-gears mr-2"></i><span class="badge badge-pill badge-primary">Conceptos: Abonos</span></div>
            <div class="card-body">
                <button type="button" id="AddConceptos" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalConceptosIngresos">+</button>
                <div class="table-responsive">
                    <table class="table table-responsive-md table-striped">
                         <thead class="">
                             <tr>
                                 <th>Id</th>
                                 <th>Nombre</th>
                                 <th>Estado</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($conceptos as $item)
                        
                                     <tr data-toggle="modal" data-target="#ModalConceptosIngresos" class="clickconcepto" id_attr="{{ $item->id }}" nombre="{{ $item->nombre }}" estado="{{ $item->estado }}" orderTable="{{ $item->orderTable }}" consecutivo="{{ $item->consecutivo }}"  >
                                         <td>{{ $item->id }}</td>
                                         <td>{{ $item->nombre }}</td>
                                         <td>    
                                             @if ($item->estado == "1")
                                                 Activo
                                             @else 
                                                 Inactivo
                                             @endif
                                         </td>
                                     </tr>
                                 
                             @endforeach
                         </tbody>
                     </table>        
                 </div>  
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-gears mr-2"></i><span class="badge badge-pill badge-primary">Elaborado Por</span></div>
            <div class="card-body">
                <button type="button" id="AddElaborado" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalElaborado">+</button>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive-md">
                         <thead class="">
                             <tr>
                                 <th>Id</th>
                                 <th>Nombre</th>
                                 <th>Estado</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($elaborados as $item)
                                     <tr data-toggle="modal" data-target="#ModalElaborado" class="clickelaborado" id_attr="{{ $item->id }}" nombre="{{ $item->nombre }}" estado="{{ $item->estado }}" >
                                         <td>{{ $item->id }}</td>
                                         <td>{{ $item->nombre }}</td>
                                         <td>    
                                             @if ($item->estado == "1")
                                                 Activo
                                             @else 
                                                 Inactivo
                                             @endif
                                         </td>
                                     </tr>
                             @endforeach
                         </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-gears mr-2"></i><span class="badge badge-pill badge-primary">Cuentas DEBE</span></div>
            <div class="card-body">
                <button type="button" id="AddDebe" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalDebe">+</button>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive-md">
                         <thead class="">
                             <tr>
                                 <th>Id</th>
                                 <th>Cuenta</th>
                                 <th>Nombre</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($debe as $item)
         
                                     <tr class="clickdebe" data-toggle="modal" data-target="#ModalDebe" id_attr="{{ $item->id }}" cuenta="{{ $item->cuenta }}" nombre="{{ $item->nombre }}">
                                         <td>{{ $item->id }}</td>
                                         <td>{{ $item->cuenta." - ".$item->nombre }}</td>
                                     </tr>
                                
                             @endforeach
                         </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-gears mr-2"></i>
                
                <span class="badge badge-pill badge-primary">Cuentas HABER</span></div>
            <div class="card-body">
                <button type="button" id="AddHaber" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalHaber">+</button>
                <div class="table-responsive">
                    <table class="table table-striped table-responsive-md">
                         <thead class="">
                             <tr>
                                 <th>Id</th>
                                 <th>Cuenta</th>
                                 <th>Nombre</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach ($haber as $item)
                                     <tr data-toggle="modal" data-target="#ModalHaber" class="clickhaber" id_attr="{{ $item->id }}" cuenta="{{ $item->cuenta }}" nombre="{{ $item->nombre }}">
                                         <td>{{ $item->id }}</td>
                                         <td>{{ $item->cuenta." - ".$item->nombre }}</td>
                                     
                                        </tr>
                             @endforeach
                         </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header"><i class="fa-solid fa-gears mr-2"></i><span class="badge badge-pill badge-primary">Conceptos: Otros Abonos</span></div>
            <div class="card-body">
                <button type="button" id="AddOConceptos" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalOtrosAbonos">+</button>
                <div class="table-responsive">
                    <table class="table table-responsive-md table-striped">
                         <thead class="">
                             <tr>
                                 <th>Id</th>
                                 <th>Nombre</th>
                                 <th>Estado</th>
                             </tr>
                         </thead>
                         <tbody>
                            @foreach ($otros as $item)
                            <tr data-toggle="modal" data-target="#ModalOtrosAbonos" class="clickOtros" id_attr="{{ $item->id }}" estado="{{ $item->estado }}" nombre="{{ $item->nombre }}">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nombre }}</td>
                                <td>    
                                    @if ($item->estado == "1")
                                        Activo
                                    @else 
                                        Inactivo
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                         </tbody>
                     </table>        
                 </div>  
            </div>
        </div>
    </div>
</div>


<!-- Modal INGRESOS -->
<div class="modal fade" id="ModalConceptosIngresos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Conceptos : Abonos </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('concepto.store') }}">
                @csrf
                <input type="text" id="concepto_id" hidden="" name="id" value="">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="concepto_nombre" class="form-control form-control-sm number-lg">
                </div>
                <div class="form-group my-2">
                   
                    <label class="radio-inline mr-3"><input id="concepto_estado1" type="radio" value="1" name="estado">Activo</label>
                    <label class="radio-inline mr-3"><input id="concepto_estado2" type="radio" value="0" name="estado">Inactivo</label>
                </div>
                <div class="form-group" id="OrderBy">
                    <p>¿Orden en la tabla?</p>
                    @if ($count == 0)
                        <label class="radio-inline mr-3 OrderBy1la"><input id="OrderBy1" type="radio" value="1" name="orderTable">Primero</label>
                    @endif
                    <label class="radio-inline mr-3 OrderBy2la"><input id="OrderBy2" checked type="radio" value="0" name="orderTable">No importa</label>
                </div>
                <div class="form-group" id="ConsecutivoP">
                    <p>¿Utiliza Consecutivo?</p>
                    <div class="form-group my-2">
                        <label class="radio-inline mr-3"><input id="consecutivoSi" checked type="radio" value="1" name="consecutivo">Si</label>
                        <label class="radio-inline mr-3"><input id="consecutivoNo" type="radio" value="0" name="consecutivo">No</label>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="reset" id="resetConceptos" class="btn btn-warning btn-sm mr-2 clearButton"><i class="fa-solid fa-broom"></i></button>
                    <button class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                </div>
                
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  
<!-- Modal Elaborado -->
<div class="modal fade" id="ModalElaborado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Elaborada Por</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('elaborado.store') }}">
                @csrf
                <input type="text" id="elaborado_id" hidden="" name="id" value="">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="elaborado_nombre" class="form-control form-control-sm number-lg">
                </div>
                <div class="form-group my-2">
                    <label class="radio-inline mr-3"><input id="elaborado_estado1" type="radio" value="1" name="estado">Activo</label>
                    <label class="radio-inline mr-3"><input id="elaborado_estado2" type="radio" value="0" name="estado">Inactivo</label>
                </div>
                <div class="d-flex">
                    <button type="reset" id="resetElaborado" class="btn btn-warning btn-sm mr-2"><i class="fa-solid fa-broom"></i></button>
                    <button class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  
<!-- Modal DEBE -->
<div class="modal fade" id="ModalDebe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Cuentas DEBE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('debe.store') }}">
                @csrf
                <input type="text" id="debe_id" hidden="" name="id" value="">
                <div class="form-group">
                    <label for="">Codigo</label>
                    <input name="cuenta" id="debe_cuenta" type="number" class="form-control form-control-sm number-lg">
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input name="nombre" id="debe_nombre" type="text" class="form-control form-control-sm number-lg">
                </div>

                <div class="d-flex">
                    <button type="reset" id="resetDebe" class="btn btn-warning btn-sm  mr-2"><i class="fa-solid fa-broom"></i></button>
                    <button class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                </div>
            </form>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  
<!-- Modal HABER -->
<div class="modal fade" id="ModalHaber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Cuentas DEBE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('haber.store') }}">
                @csrf
                <input type="text" id="haber_id" name="id" hidden="" value="">
                <div class="form-group">
                    <label for="">Codigo</label>
                    <input type="number" id="haber_cuenta" name="cuenta" class="form-control form-control-sm number-lg">
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" id="haber_nombre" name="nombre" class="form-control form-control-sm number-lg">
                </div>
                <div class="d-flex">
                    <button type="reset" id="resetHaber" class="btn btn-warning btn-sm mr-2"><i class="fa-solid fa-broom"></i></button>
                    <button class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  
<!-- Modal OTROS ABONOS -->
<div class="modal fade" id="ModalOtrosAbonos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Conceptos : Otros Abonos </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('otrosConceptos.store') }}">
                @csrf
                <input type="text" id="Oconcepto_id" hidden="" name="id" value="">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" id="Oconcepto_nombre" class="form-control form-control-sm number-lg">
                </div>
                <div class="form-group my-2">
                    <label class="radio-inline mr-3"><input id="Oconcepto_estado1" type="radio" value="1" name="estado">Activo</label>
                    <label class="radio-inline mr-3"><input id="Oconcepto_estado2" type="radio" value="0" name="estado">Inactivo</label>
                </div>
                <div class="d-flex">
                    <button type="reset" id="resetOConceptos" class="btn btn-warning btn-sm mr-2 clearButton"><i class="fa-solid fa-broom"></i></button>
                    <button class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                </div>
                
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection