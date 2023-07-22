@php
    $thead = json_decode($thead);
@endphp

<div>
    <div class="table-responsive">
        <div id="example3_wrapper" class="dataTables_wrapper no-footer">
            <table id="example3" class="display dataTable no-footer tablep" style="min-width: 845px" role="grid" aria-describedby="example3_info">
                <thead>
                    @foreach($thead as $item)
                    @if ($item->EsVacio)
                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"></th>
                    @else
                        <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">{{ $item->Columna }}</th>
                    @endif 
                    @endforeach
                    </tr>
                    </thead>
                <tbody>
                    
                    @foreach ($tbody as $item)
                    <tr>
                        @foreach($thead as $head)

                            @if ($head->EsVacio)
                                <td></td>
                            @else   
                                @php
                                $columns = $head->Origen;
                                @endphp
                                @if ($head->EsEnlace)
                                    @php
                                        $params = $head->Ruta->Parametro;
                                    @endphp
                                    <td><a href="{{ route($head->Ruta->Nombre, $item->$params) }}">{{ $item->$columns }}</a></td>    
                                @else
                                    <td>{{ $item->$columns }}</td>
                                @endif
                            @endif
                            
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
