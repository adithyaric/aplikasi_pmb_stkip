{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PMB STKIP PGRI Pacitan | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('login') }}"><img src="{{ asset('assets/img/stkip.png') }}" width="100px" height="100px"><br>
    <b>PMB </b>STKIP PGRI Pacitan</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Aplikasi PMB STKIP PGRI Pacitan</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
      <div class="form-group has-feedback">
        <input id="email" type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn') }}" required autocomplete="nisn" placeholder="Username" autofocus>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('nisn')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
      </div>
      <div class="form-group has-feedback">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  
    <!-- /.social-auth-links -->

    
    <!--<a href="{{ route('register') }}" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
      //flash message
      @if(session()->has('success'))
    swal({
        type: "success",
        icon: "success",
        title: "BERHASIL!",
        text: "{{ session('success') }}",
        timer: 5000,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false,
    });
    @elseif(session()->has('error'))
    swal({
        type: "error",
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false,
    });
    @endif
</script>
</body>
</html> --}}




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PMB STKIP PGRI PACITAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="https://entripmb.stkippacitan.ac.id/assets/img/stkip.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/login.cs') }}s">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('zenTheme/css/bootsrtap.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link type='text/css' href="{{ asset('zenTheme/css/siteman.css') }}" rel='Stylesheet' />
    <link rel="shortcut icon" href="{{ asset('zenTheme/images/logo.png') }}" />
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <img src="{{ asset('assets/img/logins.jpg') }}" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <div align="center"><img src="{{ asset('assets/img/stkip.png') }}" width="70px" alt="" border="0" class="logo"></div>
                            </div>
                            <p class="login-card-description"><a href="#">PMB STKIP PGRI PACITAN</a></p>
                            <p class="text-center">Silahkan Login</p>
                            <form class="login-form" action="{{ route('login') }}" method="post">
                                @csrf
                               <div class="form-group has-feedback">
                                  <input id="email" type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn') }}" required autocomplete="nisn" placeholder="Username" autofocus>

                                  <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                  @error('nisn')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                                </div>
                                
                                <div class="form-group has-feedback @error('password') has-error @enderror">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    @error('password')
                                        <span class="help-block">{{ $message }}</span>
                                    @else
                                        <span class="help-block with-errors"></span>
                                    @enderror
                                </div>
                                <button class="btn btn-block login-btn mb-4" type="submit" name="submit" value="submit">
                                    <i class="fa fa-sign-in"></i> LOGIN
                                </button>
                            </form>
                            <p style="margin-top: -10px;">Belum Mendaftar ? <a href="/">Daftar</a></p>

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="credit">
                <p >PMB STKIP PACITAN v2.0</p>
            </div>
        </div>
    </main>
    <a style="  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  box-shadow: 2px 2px 3px #999;
  z-index:100;" href="https://wa.me/6287755115100" target="_blank">
      <i style="margin-top:16px;" class="fa fa-whatsapp"></i>
    </a>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</body>
</html>
