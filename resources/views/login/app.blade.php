<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cartera</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dimages/favicon.png') }}">
    <link href="{{ asset('dvendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dvendor/fontawesome/css/all.css')  }}">
    <style>
        .number-lg{
    font-size: 14px !important;
}
    </style>
</head>

<body class="h-100">
    <div class="content-preloader2 show2loader">
        <div class="preloader2"></div>
    </div>
    @yield('content')

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('dvendor/global/global.min.js') }}"></script>
	<script src="{{ asset('dvendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/deznav-init.js') }}"></script>

    <script src="{{ asset('js/miles.js') }}"></script>
    <script src="{{ asset('js/settingLog.js') }}"></script>
</body>

</html>