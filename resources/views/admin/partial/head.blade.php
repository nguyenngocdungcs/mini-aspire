<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title',config('app.name'))</title>
    <base href="{{asset('')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/skin-blue.min.css') }}">

    <!-- Date Picker -->
{{--<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">--}}
{{--<link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css') }}">--}}

<!-- Daterange picker -->
    {{--<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">--}}

    <link rel="shortcut icon" href="{{ asset('" type="image/vnd.microsoft.icon') }}">

    {{--<link rel="stylesheet" href="{{ asset('AdminLTE/plugins/iCheck/all.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Loading.css') }}">

    @yield('header')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>