@extends('dash.app')

@section('page')
    Ver estudiante
@endsection
@php 
$ruta = "https://institutointesa.edu.co/".substr($student[0]->foto,6); 
date_default_timezone_set("America/Bogota");
@endphp
@section('content')
    <div class="profile card card-body px-3 pt-3 pb-0">
        <div class="profile-head">
         
            <div class="profile-info">
                <div class="profile-photo">
                    <img src=" @php echo $ruta; @endphp" class="img-fluid rounded-circle" alt="">
                </div>
                <div class="profile-details">
                    <div class="profile-name px-3 pt-2">
                        <h4 class="text-primary mb-0">{{ $student[0]->nombre }}</h4>
                        <p>CC {{ $student[0]->cedula }}</h4></p>
                    </div>
                    <div class="profile-email px-2 pt-2">
                        <h4 class="text-muted mb-0">{{ $student[0]->nombre_programa }}</h4>
                        <p><span class="badge light badge-primary">{{ $student[0]->estado }}</span></p>
                    </div>
                    <div class="profile-email px-2 pt-2">
                        <a href="{{ route('entry.ViewPdfUnitedOther',$cost->id) }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-download mr-2"></i> Pagos</a>
                    </div>
                    <div class="ml-auto d-flex">
                        <div class="mr-3">
                            <small class="text-primary"><b>Saldo a Favor</b></small>
                            <h3 class="text-success">$<span id="SaldoFavorText">0</span></h3>
                        </div>
                        <div>
                            <small class="text-primary"><b>Saldo Pendiente</b></small>
                            <h3 class="text-danger">$<span id="SaldoPendienteText">0</span></h3>
                        </div>
  
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

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
    <input type="hidden" id="pages" value="show.cartera">
    <div class="row">
        <div class="col-md-4">
            <div class="card stickyMenu mr-2 bg-gray1" id="stickyMenuWidth">
                <div class="card-body" >
                    <h4 class="text-primary my-4"><i class="fa-solid fa-sack-dollar"></i> Información de Costos</h4>
                        <form method="POST" class=" p-4" action="{{ route('cost.store') }}" id="FormValueProgram">
                            
                            @csrf
                            <input type="hidden" value="{{ $student[0]->cod_alumno }}" name="cod_alumno">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa-solid fa-dollar-sign mr-2"></i>Valor Semestre</label>
                                        <input type="text" value="{{ old('valor_semestre',$cost->valor_semestre) }}" name="valor_semestre" placeholder="" id="valor_semestre" class="form-control form-control-sm number-lg miles input-sm" onkeypress="return valideKey(event);">
                                        <div class="error_vs text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa-solid fa-hashtag mr-2"></i>Numero de Semestres</label>
                                        <input type="number" value="{{ old('numero_semestre',$cost->numero_semestre) }}" name="numero_semestre" placeholder="" id="numero_semestre" class="form-control form-control-sm number-lg" onkeypress="return valideKey(event);">
                                        <div class="error_ns text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><b><i class="fa-solid fa-dollar-sign mr-2"></i>Valor total Programa</b></label>
                                        <input type="text" value="{{ old('valor_total_semestre',$cost->valor_total_semestre) }}" name="valor_total_semestre" placeholder="" id="valor_total_semestre" readonly class="form-control form-control-sm number-lg">
                                        <div class="error_vtp text-danger ActiveError d-none"></div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label><i class="fa-solid fa-dollar-sign mr-2"></i>Descuento</label>
                                        <input type="text" value="{{ old('descuento',$cost->descuento) }}" name="descuento" placeholder="" id="descuento" class="form-control form-control-sm number-lg miles" onkeypress="return valideKey(event);">
                                        <div class="error_d text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><b><i class="fa-solid fa-dollar-sign mr-2"></i>Valor total neto del Programa</b></label>
                                        <input type="hidden" id="NetoP" value="{{ $cost->valor_neto }}">
                                        <input type="text" value="{{ old('valor_neto',$cost->valor_neto) }}" name="valor_neto" placeholder="" id="valor_neto" readonly class="form-control form-control-sm number-lg" >
                                        <div class="error_tn text-danger ActiveError d-none"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><b><i class="fa-solid fa-dollar-sign mr-2"></i>Saldo a Financiar</b></label>
                                        <input type="text" value="{{ old('saldo_financiar',$cost->saldo_financiar) }}" name="saldo_financiar" placeholder="" id="saldo_financiar"  readonly class="form-control form-control-sm number-lg">
                                        <div class="error_sf text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa-solid fa-arrow-pointer mr-2"></i>Periodo de Pago</label>
                                        <div class="dropdown bootstrap-select form-control form-control-sm number-lg">
                                            <select class="form-control form-control-sm number-lg" name="periodo" id="inputState" tabindex="-98">
                                                <option value="Semanal"  @if($cost->periodo == "Semanal") {{ "selected" }} @endif>Semanal</option>
                                                <option value="Quincenal" @if($cost->periodo == "Quincenal") {{ "selected" }} @endif>Quincenal</option>
                                                <option value="Mensual" @if($cost->periodo == "Mensual") {{ "selected" }} @endif>Mensual</option>
                                                <option value="Contado" @if($cost->periodo == "Contado") {{ "selected" }} @endif>Contado</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa-solid fa-hashtag mr-2 mt-2"></i>Numero de cuotas</label>
                                        <input type="number" name="numero_cuotas" placeholder="" value="{{ old('numero_cuotas',$cost->numero_cuotas) }}" id="numero_cuota" class="form-control form-control-sm number-lg" onkeypress="return valideKey(event);">
                                        <div class="error_nc text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><b><i class="fa-solid fa-dollar-sign mr-2"></i>Valor de Cuotas</b></label>
                                        <input type="text" name="valor_cuotas" placeholder="" value="{{ old('valor_cuotas',$cost->valor_cuotas) }}" id="valor_cuota" readonly  class="form-control form-control-sm number-lg " >
                                        <div class="error_vc text-danger ActiveError d-none"></div>
                                    </div>
                                    <div class="form-group">
                                        <label><b><i class="fa-solid fa-dollar-sign mr-2"></i>Fecha de Pago</b></label>
                                        <input type="date" name="fecha_pago" placeholder="" value="{{ old('fecha_pago',$cost->fecha_pago) }}" id="fecha_pago" class="form-control form-control-sm number-lg " >
                                        <div class="error_fp text-danger ActiveError d-none"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary btn-sm ejecutarmodal" type="submit"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
                            <div class="error_noti text-warning mt-2 font-weight-bold  ActiveError d-none"></div>
                        </form>
                </div>
            </div>
        </div>
        @if ($cost->valor_cuotas != "")
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-tab">
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs" id="content-personality">
                                    <li class="nav-item"><a href="#abono" Pestaña="abono" data-toggle="tab" class="nav-link active Pestaña">Abono</a>
                                    </li>
                                    <li class="nav-item"><a href="#otros-ingresos" Pestaña="otrosIngresos" id="" data-toggle="tab" class="nav-link Pestaña">Otros Ingresos</a>
                                    </li>
                                    <li class="nav-item"><a href="#cartera"  id="" data-toggle="tab" class="nav-link Pestaña">Cartera</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div id="abono" class="tab-pane fade active show">
                                        <div class="mt-4">
                                            <div class="d-flex">
                                                <div class="d-flex flex-row">
                                                    <button type="button" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#staticBackdrop">+</button>
                                                </div>
                                                <div class="ml-auto">
                                                    <a target="__blank" href="{{ route('entry.Viewpdf',$cost->id) }}" class="btn btn-xs bg-violet text-white"><i class="fa-solid fa-file-pdf mr-2"></i>PDF</a>
                                                </div>
                                                
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-responsive-sm">
                                                    <thead class="thead-secondary text-primary text-center">
                                                        <tr class="">
                                                            <th scope="col">Con.</th>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Concepto</th>
                                                            <th scope="col">Elaborado Por</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_items_abono">

                                                    </tbody>
                                                    <tfoot id="table_items_abono_tfoot">

                                                    </tfoot>

                                                </table>
                                            </div>
                                        </div>   
                                    </div>
                                    <div id="otros-ingresos" class="tab-pane fade">
                                        <div class="mt-4">
                                            <div class="d-flex">
                                                <div class="d-flex flex-row">
                                                    <button type="button" class="btn btn-primary btn-xxs my-2 mr-2 rounded-d ml-2 mb-4" data-toggle="modal" data-target="#ModalOtrosAbonos">+</button>
                                                </div>
                                                <div class="ml-auto">
                                                    <a target="__blank" href="{{ route('other.entry.Viewpdf',$cost->id) }}" class="btn btn-xs bg-violet text-white"><i class="fa-solid fa-file-pdf mr-2"></i>PDF</a>

                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead class="thead-secondary text-primary text-center">
                                                        <tr>
                                                            <th scope="col">Con.</th>
                                                            <th scope="col">Fecha</th>
                                                            <th scope="col">Concepto</th>
                                                            <th scope="col">Valor</th>
                                                            <th scope="col">Elaborado Por</th>
                                                            <th scope="col">Ver</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="Table_Otros_Items">

                                            
                                                    </tbody>
                                                    <tfoot id="Table_Otros_Items_foot">

                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                    <div id="cartera" class="tab-pane fade">
                                        @if ($Purses != "")
                                            <div class="mt-4">
                                                <div class="d-flex">
                       
                                                    <div class="ml-auto">
                                                        <a target="__blank" href="{{ route('purse.Viewpdfc',$cost->id) }}" class="btn btn-xs bg-violet text-white"><i class="fa-solid fa-file-pdf mr-2"></i>PDF</a>
    
                                                    </div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-responsive-sm">
                                                        <thead class="thead-secondary text-primary text-center">
                                                            <tr>
                                                                <th scope="col">Id</th>
                                                                <th scope="col">Fecha de Pago</th>
                                                                <th scope="col">Cuota</th>
                                                                <th scope="col">Abonado</th>
                                                                <th scope="col">Estado</th>
                                                                <th scope="col"></th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="TABLE_ITEMS_CARTERA">
                                                           
                                                        </tbody>
                                                        <tfoot id="TABLE_ITEMS_CARTERA_TFOOT">

                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>          
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        @endif
    </div>


  <!-- Modal -->
  <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Agregar Abono</h5>
          <button type="button" id="CloseFormEntry1" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('entry.store') }}" id="formEntry" onsubmit="return EnviarDatos(event)">
                @csrf
                <input type="hidden" id="NombreFormulario" class="nombreForm__Class" value="Entry">
                <div id="errores" class="d-none my-2">
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> Asegurate de completar los siguientes campos :
                        <ul>
                            <li>- Concepto del Abono</li>
                            <li>- Fecha del Recibo</li>
                            <li>- Valor</li>
                            <li><small>Si digitas un consecutivo, asegurate que sea en un rango menor que el utilizado.</small></li>
                        </ul>
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" value="{{ $student[0]->cod_alumno }}" name="cod_alumno">
                        <div class="form-group">
                            <label>Cedula</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->cedula }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Estudiante</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Programa</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre_programa}}" readonly>
                        </div>
                        <input type="hidden" id="id_cost" name="id_cost" value="{{ $cost->id }}">
                        <div class="form-group">
                            <label>Concepto</label>
                            
                            <select name="concepto" id="conceptoAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($conceptos as $item)
                                    @if ($item->estado == "1")
                                        <option consecutive="{{ $item->consecutivo }}" value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descripción <small class="text-danger">(Obligatorio)</small></label>
                            <textarea name="descripcion" id="descripcionAttr" class="form-control form-control-sm number-lg descripcion__Class" name="" id="" cols="30" rows="10"></textarea>
                            <div class="error_des text-danger ActiveError d-none">

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No.Recibo</label>
                            <input type="hidden" id="ConsecutivosOcupados" value="@foreach ($ConsecutivosOcupados as $item)
                            -{{ $item->no_recibo}}-
                        @endforeach" >
                            <input type="hidden" id="StartConsecutivo" value="{{ $con->num_start }}" >
                            <input name="no_recibo" id="noReciboAttr" type="number" class="form-control form-control-sm number-lg noRecibo__Class noRecibo__Class1" readonly value="{{ $con->num_current }}">
                            <div class="error_recibo text-danger ActiveError d-none">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fecha de Recibo</label>
                            <input name="fecha_recibo" value="@php echo date('Y-m-d'); @endphp" id="fechaReciboAttr" type="date" class="form-control form-control-sm number-lg fechaRecibo__Class" >
                            <div class="error_fecha text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Valor <small class="text-danger">(Obligatorio)</small></label>
                            <input name="valor" id="valorAttr" type="text" class="form-control form-control-sm number-lg miles valor__Class valor__Class_1" onkeypress="return valideKey(event);">
                            <div class="error_valor text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Elaborado Por <small class="text-danger">(Obligatorio)</small></label>
                            <select name="elaborado_por" id="elaboradoPorAttr" class="form-control form-control-sm number-lg elaborado__Class" tabindex="-98">
                                <option value="0">Busca tu nombre</option>
                                @foreach ($elaborados as $item)
                                    @if ($item->estado == "1")
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="error_elaborado text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cuenta Contable <b>DEBE</b></label>
                            <select name="debe"  id="debeAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($debe as $item)
                                    <option value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cuenta Contable <b>HABER</b></label>
                            <select name="haber" id="haberAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($haber as $item)
                                    <option value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary ejecutarmodal" id="savem"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
      </div>
    </div>
  </div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Ver Abono</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <input type="hidden" value="{{ $student[0]->cod_alumno }}" name="cod_alumno">
                <div class="form-group">
                    <label>Cedula</label>
                    <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->cedula }}"  readonly>
                </div>
                <div class="form-group">
                    <label>Estudiante</label>
                    <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre }}" readonly>
                </div>
                <div class="form-group">
                    <label>Programa</label>
                    <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre_programa}}" readonly>
                </div>
                <div class="form-group">
                    <label>Concepto</label>
                    <input type="text" id="concepto" class="form-control form-control-sm number-lg" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control form-control-sm number-lg" readonly name="" id="" cols="30" rows="5"></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label>No.Recibo</label>
                    <input name="no_recibo" id="no_recibo" type="number" class="form-control form-control-sm number-lg" readonly >
                </div>
                <div class="form-group">
                    <label>Fecha de Recibo</label>
                    <input name="fecha_recibo" id="fecha_recibo" type="date" class="form-control form-control-sm number-lg" readonly >
                </div>
                <div class="form-group">
                    <label>Valor</label>
                    <input name="valor" id="valor" type="text" class="form-control form-control-sm number-lg" readonly>
                </div>
                <div class="form-group">
                    <label>Elaborado Por</label>
                    <input name="elaborado" id="elaborado" type="text" class="form-control form-control-sm number-lg" readonly>
                </div>
                <div class="form-group">
                    <label>Cuenta Contable <b>DEBE</b></label>
                    <input name="valor" id="debe" type="text" class="form-control form-control-sm number-lg" readonly>
                </div>
                <div class="form-group">
                    <label>Cuenta Contable <b>HABER</b></label>
                    <input name="valor" id="haber" type="text" class="form-control form-control-sm number-lg" readonly>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade " id="ModalOtrosAbonos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-sack-dollar mr-2"></i>Agregar Otros Abono</h5>
          <button type="button" class="close" id="CloseOtherModal2" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('other.entry.store') }}" id="formEntry1" onsubmit="return EnviarDatos(event)">
                @csrf
                <input type="hidden" id="NombreFormulario" class="nombreForm__Class" value="Other">
                <div id="errores" class="d-none my-2">
                    <div class="alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        <strong>Error!</strong> Asegurate de completar los siguientes campos :
                        <ul>
                            <li>- Concepto del Abono</li>
                            <li>- Fecha del Recibo</li>
                            <li>- Valor</li>
                            <li><small>Si digitas un consecutivo, asegurate que sea en un rango menor que el utilizado.</small></li>
                        </ul>
                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" value="{{ $student[0]->cod_alumno }}" name="cod_alumno">
                        <div class="form-group">
                            <label>Cedula</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->cedula }}"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Estudiante</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Programa</label>
                            <input type="text" class="form-control form-control-sm number-lg" value="{{ $student[0]->nombre_programa}}" readonly>
                        </div>
                        <input type="hidden" name="id_cost" value="{{ $cost->id }}">
                        <div class="form-group">
                            <label>Concepto</label>
                            
                            <select name="concepto" id="conceptoAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($otrosConceptos as $item)
                                    @if ($item->estado == "1")
                                        <option consecutive="{{ $item->consecutivo }}" value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descripción <small class="text-danger">(Obligatorio)</small></label>
                            <textarea name="descripcion" id="descripcionAttr" class="form-control form-control-sm number-lg descripcion__Class" name="" id="" cols="30" rows="10"></textarea>
                            <div class="error_des text-danger ActiveError d-none">

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No.Recibo</label>
                            <input name="no_recibo" id="noReciboAttr" type="number" class="form-control form-control-sm number-lg noRecibo__Class noRecibo__Class2" readonly value="{{ $con->num_current }}">
                            <div class="error_recibo text-danger ActiveError d-none">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fecha de Recibo</label>
                            <input name="fecha_recibo" id="fechaReciboAttr" value="@php echo date('Y-m-d'); @endphp" type="date" class="form-control form-control-sm number-lg fechaRecibo__Class" >
                            <div class="error_fecha text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Valor <small class="text-danger">(Obligatorio)</small></label>
                            <input name="valor" id="valorAttr" type="text" class="form-control form-control-sm number-lg miles valor__Class" onkeypress="return valideKey(event);">
                            <div class="error_valor text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Elaborado Por <small class="text-danger">(Obligatorio)</small></label>
                            <select name="elaborado_por" id="elaboradoPorAttr" class="form-control form-control-sm number-lg elaborado__Class" tabindex="-98">
                                <option value="0">Busca tu nombre</option>
                                @foreach ($elaborados as $item)
                                    @if ($item->estado == "1")
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="error_elaborado text-danger d-none ActiveError">

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Cuenta Contable <b>DEBE</b></label>
                            <select name="debe"  id="debeAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($debe as $item)
                                    <option value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cuenta Contable <b>HABER</b></label>
                            <select name="haber" id="haberAttr" class="form-control form-control-sm number-lg" tabindex="-98">
                                @foreach ($haber as $item)
                                    <option value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary ejecutarmodal" id="savem"><i class="fa-solid fa-floppy-disk mr-2"></i>Guardar</button>
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
    </form>
      </div>
    </div>
  </div>


  <form  method="POST" action="{{ route('purse.all') }}" id="purseAll">
    @csrf
    <input type="hidden" name="id" value="{{ $cost->id }}">
  </form>

  <form  method="POST"  id="FormPurseHistory1">
    @csrf
    <input type="hidden" name="id_cost" value="{{ $cost->id }}">
  </form>

  <form id="FormRequestOtros">
    @csrf
    <input type="hidden" name="id" id="IdContentOperation" value="">

  </form>

  <button type="button" id="buttonShowEditFecha" class="btn btn-primary mb-2 d-none" data-toggle="modal" data-target="#showEditFecha">Small modal</button>
  <div class="modal fade" id="showEditFecha" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modificar Fecha</h5>
                <button type="button" id="CloseModalPurse" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('purse.edit') }}" id="FormPurseEdit">
                @csrf

            <div class="modal-body" >
                <input type="hidden" id="ContentPurseID" name="id" value="">
                <div class="form-group">
                    <label>Fecha de Pago</label>
                    <input type="date" class="form-control form-control-sm number-lg" id="ContentPurseDATE" name="fecha_pago" value="">
                    <div class="error_fecha text-danger ActiveError d-none">

                    </div>
                </div>
                <div class="form-group">
                    <label>Valor de Cuota</label>
                    <input type="text" class="form-control form-control-sm miles number-lg" onkeypress="return valideKey(event);" id="ContentPurseCUOTA" name="cuota" value="">
                    <div class="error_valor text-danger ActiveError d-none">

                    </div>
                </div>
                <div>
                    <label>Comentario</label>
                    <textarea name="comentario" id="comentarioP" class="form-control" id="" cols="30" rows="10"></textarea>
                    <div class="error_comentario text-danger ActiveError d-none">

                    </div>
                </div>
                <div class="custom-control custom-checkbox mb-3 checkbox-warning my-2">
                    <input type="checkbox" class="custom-control-input" value="todos" name="ModifyInputLabel" id="customCheckBox4">
                    <label class="custom-control-label" for="customCheckBox4">Modificar todas hacia abajo.</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                <button type="submit" class="btn btn-primary btn-sm ejecutarmodal"><i class="fa-solid fa-floppy-disk"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>


<button type="button" id="ButtonModalHistory" class="btn btn-primary mb-2 d-none" data-toggle="modal" data-target="#ModalHistory" >Small modal</button>
  <div class="modal fade" id="ModalHistory" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" id="CloseModalHistory" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped table-responsive-sm">
                    <thead class="thead-secondary text-primary text-center">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Fecha de Pago</th>
                            <th scope="col">Cuota</th>
                            <th scope="col">Comentario</th>
                            <th scope="col">Registro</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tableHistory">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light btn-sm" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>
</div>

<button type="button" id="ButtonadminModal1" class="btn btn-primary mb-2 d-none" data-toggle="modal" data-target="#adminModal1" >Small modal</button>
<div class="modal fade" id="adminModal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea eliminar este Items?</h5>
                <button type="button" id="CloseadminModal1" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ModalPasswordAdmin" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="ElimationPorID">
                    <div class="form-group">
                        <label>Contraseña (Administrador)</label>
                        <input type="password" name="password" class="form-control form-control-sm number-lg" id="passwordADMIN"  >
                        <div class="error_password text-danger ActiveError d-none">
    
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash mr-2"></i>Eliminar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<button type="button" id="ButtonadminModal2" class="btn btn-primary mb-2 d-none" data-toggle="modal" data-target="#adminModal2" >Small modal</button>
<div class="modal fade" id="adminModal2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" id="CloseadminModal2" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <div class="modal-body" id="contentResponse">
                
                    
            </div>
        </div>
    </div>
</div>

<button type="button" id="ButtonTickets" class="btn btn-primary mb-2 d-none" data-toggle="modal" data-target="#Tickets" >Small modal</button>
<div class="modal fade" id="Tickets" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" id="CloseTickets" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <div class="modal-body" id="contentTickets">
                <img
                src="{{ asset('dimages/LogoIntesa.png') }}"
                alt="Logotipo">
            <p class="text-center">TICKET DE VENTA<br>New New York<br>17/10/2017
                02:22 a.m.</p>
                <table class="">
                    <thead>
                        <tr>
                            <th>CANT</th>
                            <th>PRODUCTO</th>
                            <th>$$</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>papa</td>
                            <td>$1500</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>papa</td>
                            <td>$1000</td>
                        </tr>
                    </tbody>
                </table>

                <button class="btn btn-primary btn-sm">Imprimir</button>

            </div>
        </div>
    </div>
</div>

<div class="ventanaFlotanteOver">
    Hola mundo.
</div>

@endsection