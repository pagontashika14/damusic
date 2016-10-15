<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Music4ME | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css',env('HTTPS_ASSET'))}}">
  <!-- Font-awesome -->
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css',env('HTTPS_ASSET'))}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('ionicons/css/ionicons.min.css',env('HTTPS_ASSET'))}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/AdminLTE.min.css',env('HTTPS_ASSET'))}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/iCheck/square/blue.css',env('HTTPS_ASSET'))}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Music</b>4ME</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc của bạn</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Nhớ đăng nhập
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button class="btn btn-primary btn-block btn-flat" onclick="login()">Đăng nhập</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

    <a href="#">Quên mật khẩu</a><br>
    <a href="/register" class="text-center">Đăng ký thành viên</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('js/jquery-3.1.1.min.js',env('HTTPS_ASSET')) }}"></script>
<!-- Bootstrap 3 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js',env('HTTPS_ASSET'))}}"></script>
<!-- iCheck -->
<script src="{{asset('admin-lte/plugins/iCheck/icheck.min.js',env('HTTPS_ASSET'))}}"></script>

<script src="{{ asset('js/login/login.js',env('HTTPS_ASSET')) }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  var token = $('meta[name="csrf-token"]').attr('content');
  console.log(token);
  function login(){
    var login = new Login('admin','123');
    login.login();
  }
</script>
</body>
</html>
