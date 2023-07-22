<div>
      <div class="row">

        <div class="col-md-12">
          <form action="{{ route('receipts.store') }}" method="POST" id="formatReceiptForm" >
            <div class="formatReceipt">
              <div class="formatReceipt-header ">
                <div class="formatReceipt-header-d">
                  <div class="formatReceipt-header-date">
                    <div class="formatReceipt-header-date-title text-center bg-white font-wight-bold">
                      Fecha
                    </div>
                    @if($content != null)
                          @php
                              $fecha = explode("-",$content->created_at);
                          @endphp
                    @endif
                    <div class="formatReceipt-header-date-body">
                      <div  class="formatReceipt-header-date-body-item">
                        @if($content != null)
                          {{ (explode(" ", $fecha[2]))[0] }}
                        @else
                          {{ date('d')}}
                        @endif

                      </div>
                      <div class=" formatReceipt-header-date-body-item">
                        @if($content != null)
                          {{ $fecha[1] }}
                        @else
                          {{ date('m')}}
                        @endif
                      </div>
                      <div class="formatReceipt-header-date-body-item">
                        @if($content != null)
                          {{ $fecha[0] }}
                        @else
                          {{ date('Y')}}
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" text-center formatReceipt-header-title" @if ($types == "entry") style="background:#0d0251;" @else style="background:#456a09;"  @endif>
                  <div>
                    {{ $title }}
                  </div>

                </div>
                <div  class=" formatReceipt-header-consecutive">
                  <div>
                    <span id="showConsecutiveReceipts"> 
                      @if ($content != null)
                        {{ $content->no_recibo }}
                      @else
                        {{ $consecutive->num_current }}
                      @endif 
                    </span>
                    <input type="text" class="d-none" id="showInputSearchReceipts">
                    @if($content != null)
                      <a href="{{ route('third.receipts.'.$types) }}" class="btn-new-receipt"><i class="fa-solid fa-circle-plus"></i></a>
                    @else
                      <button type="button" id="changeConsecutiveInputReceipts" class="btn-rotate-consecutive"><i class="fa-solid fa-arrows-rotate"></i></button>
                    @endif
                  </div>

                </div>
              </div>
              <div class="formarReceipt-body">
                  @if($content != null)
                  <input type="hidden" name="id" value="{{ $content->id  }}">
                  <input type="hidden" name="no_recibo" value="{{ $content->no_recibo }}">
                  @else
                  <input type="hidden" name="no_recibo" value="{{ $consecutive->num_current  }}">
                  @endif
                 
                <input type="hidden" id="TypeReceipts" name="type" value="{{ $types }}">
                @csrf
                <div class="formarReceipt-body-item ">
                  <div class="formarReceipt-body-item-cell">
                      <span>Tercero <small class="text-danger errorThirdReceipt d-none">(Completa este campo)</small></span>
                      <input type="hidden" name="third" id="thirdID" @if($content != null){ value="{{ $content->thirdObject->id }}" } @endif >
                      <input type="text" id="thirdInput" @if($content != null){ value="{{ $content->thirdObject->nombre }}" } @endif >
                      <ul class="listItems d-none">
                        <li>Juan</li>
                        <li>Pedro</li>
                      </ul>
                  </div>
                  <div class="formarReceipt-body-item-cell">
                    <span>Debe</span>
                      <select name="debe"  id="debeAttr2" class="d-none" >
                        @foreach ($debe as $item)
                            <option @if($no_recibo != null && $content->debe == $item->id){ Selected } @endif value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                        @endforeach
                    </select>
                      <input readonly type="text" id="SelectDebe">
                  </div>
                </div>
                <div class="formarReceipt-body-item ">
                  <div class="formarReceipt-body-item-cell">
                      <span>Concepto</span>
                      <select style="background-color: #fff" class="formarReceipt-body-item-cell-select" name="concepto" id="changeConceptoThird">
                        @foreach($concepts as $item)
                          @if ($item->state == 1)
                            <option @if($content != null && $item->id == $content->concepto){ Selected } @endif  debe="{{ $item->debe }}" haber="{{ $item->haber }}" value="{{ $item->id }}">{{ $item->name }}</option>
                          @endif
                        @endforeach
                      </select>
                  </div>
                  <div class="formarReceipt-body-item-cell">
                    <span>Haber</span>
                      <input readonly type="text" id="SelectHaber">
                      <select name="haber" id="haberAttr2" class="d-none" >
                        @foreach ($haber as $item)
                            <option value="{{ $item->id }}">{{ $item->cuenta }} - {{ $item->nombre }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="formarReceipt-body-item">
                  <div class="formarReceipt-body-item-celld">
                    <span>Detalles</span>
                      <textarea name="detalles" id="" cols="30" rows="5">@if($content != null){{ $content->detalles }} @endif</textarea>
                  </div>
                </div >
                <div class="formarReceipt-body-item ">
                  <div class="formarReceipt-body-item-cell-radio">
                    <span>Elije una Opción</span>
                    <div>
                      <div class="form-check-inline">
                        <input @if($content != null && $content->forma == "Efectivo") {checked } @endif name="forma" class="form-check-input" type="radio" value="Efectivo" checked id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Efectivo
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <input @if($content != null && $content->forma == "Consignación"){ checked } @endif name="forma" class="form-check-input" type="radio" value="Consignación"  id="flexRadioDefault2" >
                        <label class="form-check-label" for="flexRadioDefault2">
                          Consignación
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="formarReceipt-body-item-cell-elaborado">
                    <span>Elaborado Por</span>
                      <select name="elaborado_por" class="formarReceipt-body-item-cell-select-2" id="">
                        @foreach($elaborados as $item)
                          <option @if($content != null && $item->id == $content->elaborado_por){ Selected } @endif value="{{ $item->id }}" >{{ $item->nombre }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="formarReceipt-body-item">
                  <div class="formarReceipt-body-item-cash">
                    <span>Valor <small class="text-danger errorValueReceipt d-none">(Completa este campo)</small></span>
                    <div class="formarReceipt-body-item-cell-inputValor">
                      <div class="formarReceipt-body-item-cell-inputValor-signal">
                        $
                      </div>
                      @php
                        if($content != null){
                          $valor  = str_replace(',','.',strval(number_format($content->valor)));
                        }
                      @endphp
                      <div class="formarReceipt-body-item-cell-inputValor-dinput">
                        <input name="valor" type="text" class="miles" id="valor" @if($content != null){
                          value="{{$valor}}"
                        }
                            
                        @endif />
                      </div>
                    </div>

                  </div>
                  <div class="formarReceipt-body-item-button">
                    <div>
                      @if ($content != null)
                      <span>Desea guardar el recibo?</span>
                      <button class="formarReceipt-body-item-button-first"><i class="fa-solid fa-hand-pointer mr-2"></i>Guardar</button>
                      @else
                        <span>Desea crear el recibo?</span>
                        <button class="formarReceipt-body-item-button-first"><i class="fa-solid fa-hand-pointer mr-2"></i>Crear</button>
                      @endif
                    </div>
                  </div>
                </div >
              </div>
            </div>

          </div>
        </form>
        </div>

      <hr>
</div>