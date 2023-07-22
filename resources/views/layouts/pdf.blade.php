<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('dvendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dvendor/fontawesome/css/all.css')  }}">


</head>
<body id="body">
    <nav class="navbar navbar-light bg-white" style="height:70px;width: 100%;margin-bottom:15px;">
        <a class="navbar-brand" href="#" style="display: inline-block;width: 55%;font-size:14px;text-decoration: none;">

                <div style="display: inline-block;width: 35%;margin-top:20px;" >

                    @php
                        $img = base_path('public\dimages\logoIntesa.png');
                        $type = pathinfo($img,PATHINFO_EXTENSION);
                        $data1 = file_get_contents($img);
                        $pic = 'data:image/'.$type. ';base64,'.base64_encode($data1);
                    @endphp 
                    <img src="{{ $pic }}" width="120" height="80" class="d-inline-block align-top" alt="">

                </div>
                <div class="ml-4" style="color:#000000;;font-size:12px;">
                    <b >INSTITUTO TECNICO DEL SABER</b> <br>
                    Educación para el trabajo y el desarrollo humano
                </div>
        </a>
        <div class="ml-auto text-black" style="display: inline-block;width: 40%;text-align:right;font-size:12px;margin-bottom:22px;">

                <b>Sede Barrancabermeja, Barrio Galan. <br>
                    Calle 51 No.16-66</b>
                    <br>Telefono: 622 321 - 
                    Celular: 322 3647768
                    <br><b>www.institutointesa.edu.co </b><br>
        </div>
      </nav>
      <div class="my-3">

      </div>
      <div class="container-fluid">
        @yield('content')
      </div>

      <footer style="text-align:center;position: absolute;bottom: 0;width:100%;">
        <i>Licencia de Funcionamiento según Resolución No. 3021 del 15 de diciembre de 2015</i><br> <b>Barrancabermeja - Santander</b>
        <b style="display: inline;"> @livewire('setting.date', ['date' => date('Y-m-d'), 'type' => 'inline'])</b>
      </footer>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
      <script src="{{ asset('js/pdfGenerator.js') }}"></script>
</body>
</html>
