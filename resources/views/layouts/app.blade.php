<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nghe nhạc trực tuyến</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css',env('HTTPS_ASSET'))}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css',env('HTTPS_ASSET'))}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('ionicons/css/ionicons.min.css',env('HTTPS_ASSET'))}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/AdminLTE.min.css',env('HTTPS_ASSET'))}}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/skins/skin-purple.min.css',env('HTTPS_ASSET'))}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-purple sidebar-mini">
@include('general.alert')
<div class="wrapper">
  <!-- Main Header -->
  @include('layouts.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content-header')
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.footer')

  <!-- Control Sidebar -->
  @include('layouts.control-sidebar')
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET'))}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js',env('HTTPS_ASSET'))}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/app.min.js',env('HTTPS_ASSET'))}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script src="{{ asset('slim-scroll/jquery.slimscroll.min.js',env('HTTPS_ASSET')) }}"></script>
<script src="{{ asset('js/helper.js',env('HTTPS_ASSET')) }}"></script>
@stack('scripts')
</body>
</html>