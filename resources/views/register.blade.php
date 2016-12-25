<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DaMusic | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3 -->
  <link rel="stylesheet" href="/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <!-- Font-awesome -->
  <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin-lte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/admin-lte/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/"><b>DaMusic</b>4ME</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Đăng ký thành viên mới</p>

    <div>
      <div class="form-group has-feedback">
        <input id="name" type="text" class="form-control" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="repassword" type="password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Tôi đồng ý với <a href="#">điều khoản</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button onclick="register()" class="btn btn-primary btn-block btn-flat">Đăng ký</button>
        </div>
        <!-- /.col -->
      </div>
    </div>

    <a id="login-link" href="/login" class="text-center">Tôi đã có tài khoản</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3 -->
<script src="/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/admin-lte/plugins/iCheck/icheck.min.js"></script>
<script src="/js/notify.min.js"></script>
<script src="js/login/login.js"></script>
<script>
  var currentLink = '{{ $current_link }}';
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    $('#login-link').attr('href','/login?current_link='+currentLink);
  });

  function register() {
    let name = $('#name').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let repassword = $('#repassword').val();
    if(!(name&&email&&password)) {
      $.notify("Bạn phải điền cái gì đi chứ", {
          globalPosition: 'bottom left',
          className: 'error',
      });
      return;
    }
    if(password != repassword) {
      $.notify("Password không trùng nhau", {
          globalPosition: 'bottom left',
          className: 'error',
      });
      return;
    }
    $.ajax({
      url: '/api/register',
      method: 'POST',
      data: {
        name: name,
        email: email,
        password: password
      },
      success: function(data) {
        $.notify("Đăng ký thành công", {
            globalPosition: 'bottom left',
            className: 'success',
        });
        var login = new Login(email,password);
        login.login(function(success,data){
          if (success) {
            localStorage.setItem("api_token", data.api_token);
            sessionStorage.setItem("hello_message", data.name);
            location.replace(currentLink);
          } else {
            $.notify("Error", {
                globalPosition: 'bottom left',
                className: 'success',
            });
          }
        });
      },
      error: function(data) {
        console.log('--error--');
        console.log(data);
      }
    });
  }
</script>
</body>
</html>
