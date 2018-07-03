<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin/images/favicon.ico')}}">

    <title>Med @yield('pageTitle')</title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap/dist/css/bootstrap.css')}}">


    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css')}}">

    <!-- theme style -->
    <link rel="stylesheet" href="{{ asset('admin/css/master_style.css')}}">

    <!-- MinimalPro Admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/css/skins/_all-skins.css')}}">

    <!-- Vector CSS -->
    <link href="{{ asset('admin/assets/vendor_components/jvectormap/lib2/jquery-jvectormap-2.0.2.css')}}"
          rel="stylesheet"/>

    <!-- date picker -->
    <link rel="stylesheet"
          href="{{ asset('admin/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">

    <!-- daterange picker -->
    <link rel="stylesheet"
          href="{{ asset('admin/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css')}}">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
          href="{{ asset('admin/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/taginput.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">


    <!-- style for hide spinner for input type="nymber" athir-->
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"
             integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
             crossorigin="anonymous"></script>--}}
    <script src="{{ asset('admin/js/jquery-3.3.1.min.js')}}"></script>

    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->


</head>

<body>


<!-- Date by coupon -->
<!-- jQuery Knob -->
<script src="{{asset('admin/assets/vendor_components/jquery-knob/js/jquery.knob.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- MinimalPro Admin for inline Chart purposes -->
<script src="{{asset('admin/js/pages/widget-inline-charts.js')}}"></script>
<!-- end Date by coupon -->


@include('partials.admin.header')
@if(Auth::user()->hasRole('SuperAdmin'))
    @include('partials.superadmin.sidebar')
@elseif(Auth::user()->hasRole('admin'))
    @include('partials.admin.sidebar')
@elseif(Auth::user()->hasRole('hq_admin'))
    @include('partials.hqadmin.sidebar')
@endif



@yield('content')
@include('partials.admin.footer')

</body>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>--}}

<!-- popper -->

<script src="{{ asset('admin/assets/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('admin/assets/vendor_components/bootstrap/dist/js/bootstrap.js')}}"></script>

<!-- ChartJS -->
<script src="{{ asset('admin/assets/vendor_components/chart-js/chart.js')}}"></script>

<!-- Sparkline -->
<script src="{{ asset('admin/assets/vendor_components/jquery-sparkline/dist/jquery.sparkline.js')}}"></script>

<!-- daterangepicker -->
<script src="{{ asset('admin/assets/vendor_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('admin/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- datepicker -->
<script src="{{ asset('admin/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

<!-- Slimscroll -->
<script src="{{ asset('admin/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- FastClick -->
<script src="{{ asset('admin/assets/vendor_components/fastclick/lib/fastclick.js')}}"></script>

<!-- peity -->
<script src="{{ asset('admin/assets/vendor_components/jquery.peity/jquery.peity.js')}}"></script>

<!-- MinimalPro Admin App -->
<script src="{{ asset('admin/js/template.js')}}"></script>

<!-- MinimalPro Admin dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/js/pages/dashboard.js')}}"></script>

<!-- MinimalPro Admin for demo purposes -->
<script src="{{ asset('admin/js/demo.js')}}"></script>

<script src="{{ asset('admin/js/taginput.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>


@yield('javascript')
{{-- @include('partials.admin.footer')--}}
<!-- Scripts -->

</html>
