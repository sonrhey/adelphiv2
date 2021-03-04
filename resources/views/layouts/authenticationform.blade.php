<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('template_styles/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/slicknav.min.css')}}">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('template_styles/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('template_styles/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{asset('template_styles/js/vendor/jquery-2.2.4.min.js')}}"></script>
</head>
<body>
@yield('content')
    <!-- bootstrap 4 js -->
    <script src="{{asset('template_styles/js/popper.min.js')}}"></script>
    <script src="{{asset('template_styles/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template_styles/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template_styles/js/metisMenu.min.js')}}"></script>
    <script src="{{asset('template_styles/js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('template_styles/js/jquery.slicknav.min.js')}}"></script>
    <!-- others plugins -->
    <script src="{{asset('template_styles/js/plugins.js')}}"></script>
    <script src="{{asset('template_styles/js/scripts.js')}}"></script>
</body>
</html>
