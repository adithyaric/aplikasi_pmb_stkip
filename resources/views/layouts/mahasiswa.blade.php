<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PMB STKIP PGRI PACITAN</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/stkip.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    @stack('prepend-styles')
    @include('includes.styles')
    @stack('addon-styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            .blink {
              animation: blink 3s infinite;
        }

        @keyframes blink {
          0% {
            opacity: 1;
          }
          50% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }
        </style>
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>STKIP</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>PMB</b>STKIP</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(Auth::user()->photo)
                                <img src="{{ Storage::url( Auth::user()->photo) }}" class="user-image"
                                    style="width:30px; height:30px;" alt="">
                                <!-- <br> -->
                                @else
                                <img src="{{ asset('assets/img/default.jpg') }}" class="user-image"
                                    style="width:30px; height:30px;" alt="">
                                <!-- <br> -->
                                @endif
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if(Auth::user()->photo)
                                    <img src="{{ Storage::url( Auth::user()->photo) }}" class="w-100"
                                        style="width:50px; height:50px" alt="">
                                    <br>
                                    @else
                                    <img src="{{ asset('assets/img/default.jpg') }}" class="w-100"
                                        style="width:50px; height:50px" alt="">
                                    <br>
                                    @endif

                                    <p>
                                        {{ Auth::user()->name }}
                                        <br>
                                        {{ @Auth::user()->mahasiswa->jurusan->name }}
                                        <small>{{ Auth::user()->email }}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('profile.mahasiswa') }}"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="{{route('logout')}}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST"
                                            style="display: none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        @if(Auth::user()->photo)
                        <img src="{{ Storage::url( Auth::user()->photo) }}" class="w-100"
                            style="width:50px; height:50px" alt="">
                        <br>
                        @else
                        <img src="{{ asset('assets/img/default.jpg') }}" class="w-100" style="width:50px; height:50px"
                            alt="">
                        <br>
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->

                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- <li class="header">MAIN NAVIGATION</li> --}}
                    <li class="{{ setActive('admin/dashboard') }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

                        </a>

                    </li>

                    <li class="{{ setActive('mahasiswa/data') }}">
                        <a href="{{ url('mahasiswa/data') }}">
                            <i class="fa fa-dashboard"></i> <span>Pilih Jalur & Upload Berkas</span>

                        </a>

                    </li>
                    <li class="{{ setActive('mahasiswa/biodata') }}">
                        <a href="{{ route('biodata.index', ['active_tab' => 'tab_1']) }}">
                            <i class="fa fa-dashboard"></i> <span>Isi Biodata </span>

                        </a>

                    </li>
                    {{-- <li class="{{ setActive('mahasiswa/uploads') }}">
                    <a href="{{ url('mahasiswa/uploads') }}">
                        <i class="fa fa-dashboard"></i> <span>Upload Berkas</span>

                    </a>

                    </li> --}}

                    <li class="{{ setActive('mahasiswa/cetak') }}">
                        <a href="{{ url('mahasiswa/cetak') }}">
                            <i class="fa fa-dashboard"></i> <span>Verifikasi & Cetak Kartu</span>

                        </a>

                    </li>


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('includes.footer')


        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
