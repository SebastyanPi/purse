<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>INTESA -@yield('page')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dimages/favicon.png') }}">
    <link href="{{ asset('dvendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{  asset('dvendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('dvendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('dvendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/LineIcons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('dvendor/fontawesome/css/all.css')  }}">
    <script async src="{{ asset('js/googlemanager.js')  }}"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-V469GS1LH2');
    </script>
    @livewireStyles
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div class="content-preloader2 show2loader">
        <div class="preloader2"></div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('dash.nav-header')
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		@include('dash.chat-box')
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
        @include('dash.header-start')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('dash.sidebar-start')
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <strong>Muy bien!</strong> {{ session('success') }}
                        <button type="button" class="close h-100 text-white" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close text-white"></i></span>
                        </button>
                    </div>
                @endif
        		@yield('content')
			</div>
		</div>
        <!--**********************************
            Content body end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <script src="{{ asset('js/plugin-ticket-js/Impresora.js') }}"></script>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('dvendor/global/global.min.js') }}"></script>
	<script src="{{ asset('dvendor/bootstrap-select/dist/js/bootstrap-select.min.js') }} "></script>
	<script src="{{ asset('dvendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
	<script src="{{ asset('js/deznav-init.js') }}"></script>
	
	<!-- Counter Up -->
    <script src="{{ asset('dvendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dvendor/jquery.counterup/jquery.counterup.min.js') }}"></script>	
		
	<!-- Apex Chart -->
	<script src="{{ asset('dvendor/apexchart/apexchart.js') }}"></script>	
	
	<!-- Chart piety plugin files -->
	<script src="{{ asset('dvendor/peity/jquery.peity.min.js') }}"></script>
	


	<!-- Dashboard 1 -->
	<script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
	

      <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dvendor/datatables2/DataTables-1.12.1/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/Buttons-2.2.3/js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/Buttons-2.2.3/js/buttons.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/Buttons-2.2.3/js/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dvendor/datatables2/Buttons-2.2.3/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('js/Impresiones.js') }}"></script>
    <script src="{{ asset('js/miles.js') }}"></script>
    <script src="{{ asset('js/cartera.js') }}"></script>
    <script src="{{ asset('js/setting.js') }}"></script>
    <script src="{{ asset('js/abonos.js') }}"></script>
    <script src="{{ asset('js/otrosAbonos.js') }}"></script>
    <script src="{{ asset('js/onload.js') }}"></script>
    <script src="{{ asset('js/thirdEntry.js') }}"></script>

    @livewireScripts
    


  
</body>
</html>