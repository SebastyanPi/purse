<div class="text-black">
    @php
        $suma = 0;
    @endphp
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <style>
        table, th, td {
        border: 1px solid black !important;
        border-collapse: collapse !important;
        }
        table tr:nth-child(odd)
        { background-color: #fff;
        }
        table tr:nth-child(even)
        { background-color: #e7e9eb;
        }
    </style>
    @if ($id_cost != 0)
    <table id="table" style="width: 100%;" class=""> 
        <thead style="" class="thead-secondary text-black text-center">
            <th scope="col">ID</th>
            <th scope="col">Fecha de Pago</th>
            <th scope="col">Cuota</th>
            <th scope="col">Abonado</th>
            <th scope="col">Estado</th>
        </thead>
        <tbody>

            @php

                $total = $entries[0]->TotalAbono; 
                $saldoFecha = 0;
                $SaldoPendiente = 0;
                $SaldoAFavor = 0;
                $hoy = date('y-m-d');
                $i = 0;
                $CuotasTotal = 0;
            @endphp

            @foreach ($purses as $item)
                @php 

                $i++;
                $isVencida = false;
                $valueShow = 0;
                $CuotasTotal += $item->cuota; 

                if(strtotime($hoy) > strtotime($item->fecha_pago)){
                    $isVencida = true;
                }

                if($total >=  $item->cuota){
                    $estado = 'Al dia';
                    $total = $total - $item->cuota;
                    $valueShow = $item->cuota;

                }elseif($isVencida){
                    $estado = 'En Mora';

                    if($total > 0){
                        $val = $item->cuota - $total;
                        $SaldoPendiente += $val;  //Se suma a lo pendiente
                        $valueShow = $total; //Lo que se desea mostrar 
                        $total = 0; //Lo igualamos porque es mayor a 0
         
                    }else{
                        $SaldoPendiente += $item->cuota;
                    }  

                }else{
                    $estado = 'Proxima';
                    if($total > 0){
                        $valueShow = $total;
                        $total = 0;

                    }else{
                        $valueShow = 0;

                    }
                }
                if($valueShow > 0 && $isVencida == false){
                    $SaldoAFavor += $valueShow;
                }

                @endphp
                
                @if($estado == 'Al dia')
                    <tr style="background-color:#2bc155;color:#fff;">
                @elseif($estado == 'Proxima' && $isVencida == false && $valueShow > 0)
                    <tr style="background-color:#98ce04;color:#fff;">
                @elseif($estado == 'En Mora')
                    <tr style="background-color:#f72b50;color:#fff;">    
                @else       
                    <tr>
                @endif
   
                    <td style="text-align:center;" class="text-center text-black">{{ $i}}</td>
                    <td style="text-align:center;" class="text-center text-black">@livewire('setting.date', ['date' => $item->fecha_pago])</td>
                    <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $item->cuota])</td>
                    @if($valueShow > 0)
                        <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $valueShow])</td>
                    @else
                        <td style="text-align:right;" class="text-center text-black"></td>
                    @endif
                    <td style="text-align:center;" class="text-center text-black">{{$estado}}</td>
                </tr>
            @endforeach

            <tr style="background-color:#0e00ce;color:#fff;">
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black">Total Programa</td>
                <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $CuotasTotal])</td>
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black"></td>
            </tr>

            <tr style="background-color:#585858;color:#fff;">
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black">Total Abono</td>
                <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $entries[0]->TotalAbono])</td>
                <td style="text-align:center;" class="text-center text-black"></td>
            </tr>
            <tr style="background-color:#F3CAD5 ;">
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black">Saldo Pendiente</td>
                <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $SaldoPendiente])</td>
                <td style="text-align:center;" class="text-center text-black"></td>
            </tr>
            <tr style="background-color:#dcecb0;">
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black"></td>
                <td style="text-align:center;" class="text-center text-black">Saldo a Favor</td>
                <td style="text-align:right;" class="text-center text-black">@livewire('setting.money', ['money' => $SaldoAFavor])</td>
                <td style="text-align:center;" class="text-center text-black"></td>
            </tr>
        </tbody>
       
    </table>
    @endif 
</div>
