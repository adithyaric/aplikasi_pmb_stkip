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
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>PMB</b></span>
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
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle"
                                        alt="User Image">

                                    {{-- <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p> --}}
                                </li>
                                <!-- Menu Body -->
                                {{-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li> --}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        {{-- <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> --}}
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
                        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
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
                    <li class="{{ setActive('admin/mahasiswa') }}">
                        <a href="{{ route('admin.mahasiswa.index') }}">
                            <i class="fa fa-users"></i> <span>Mahasiswa</span>

                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://panel.brismartbilling.id/signin/index">
                            <i class="fa fa-dollar"></i> <span>Data Pembayaran</span>

                        </a>
                    </li>
                    <!--<li>-->
                    <!--    <a target="_blank" href="https://gel1.stkippacitan.ac.id/login">-->
                    <!--        <i class="fa fa-dashboard"></i> <span>Rekap Gelombang 1</span>-->

                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a target="_blank" href="https://gelombang2.stkippacitan.ac.id/login">-->
                    <!--        <i class="fa fa-dashboard"></i> <span>Rekap Gelombang 2</span>-->

                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a target="_blank" href="https://gel3.stkippacitan.ac.id/login">-->
                    <!--        <i class="fa fa-dashboard"></i> <span>Rekap Gelombang 3</span>-->

                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--    <a target="_blank" href="https://gel4.stkippacitan.ac.id/login">-->
                    <!--        <i class="fa fa-dashboard"></i> <span>Rekap Gelombang 4</span>-->

                    <!--    </a>-->
                    <!--</li>-->



                    <li
                        class="{{ setActive('admin/jurusan') }} {{ setActive('admin/penerimaan') }} {{ setActive('admin/transaction') }} {{ setActive('admin/video') }} {{ setActive('admin/gelombang') }} {{ setActive('admin/tahun') }} {{ setActive('admin/persyaratan') }} {{ setActive('admin/pengumuman') }} {{ setActive('admin/setting') }} treeview">
                        <a href="#">
                            <i class="fa fa-th"></i> <span>Setting</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ setActive('admin/gelombang') }}">
                                <a href="{{ route('admin.gelombang.index') }}">
                                    <i class="fa fa-users"></i> <span>Gelombang</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/jurusan') }}">
                                <a href="{{ route('admin.jurusan.index') }}">
                                    <i class="fa fa-users"></i> <span>Jurusan</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/kelas') }}">
                                <a href="{{ route('admin.kelas.index') }}">
                                    <i class="fa fa-circle"></i> <span>Kelas</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/persyaratan') }}">
                                <a href="{{ route('admin.persyaratan.index') }}">
                                    <i class="fa fa-circle"></i> <span>Persyaratan</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/penerimaan') }}">
                                <a href="{{ route('admin.penerimaan.index') }}">
                                    <i class="fa fa-users"></i> <span>Jalur Penerimaan</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/tahun') }}">
                                <a href="{{ route('admin.tahun.index') }}">
                                    <i class="fa fa-calendar"></i> <span>Tahun</span>
                                </a>
                            </li>
                            {{-- <li class="{{ setActive('admin/video') }}"> --}}
                                {{-- <a href="{{ route('admin.video.index') }}"> --}}
                                    {{-- <i class="fa fa-youtube"></i> <span>Youtube</span> --}}
                                {{-- </a> --}}
                            {{-- </li> --}}
                            <li class="{{ setActive('admin/pengumuman') }}">
                                <a href="{{ route('admin.pengumuman.index') }}">
                                    <i class="fa fa-newspaper-o"></i> <span>Pengumuman</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/setting') }}">
                                <a href="{{ route('admin.setting.index') }}">
                                    <i class="fa fa-gear"></i> <span>Web</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="{{ setActive('admin/report/jalur') }} {{ setActive('admin/report/prodi') }}
                        {{ setActive('admin/report/penerimaan') }} treeview">
                        <a href="#">
                            <i class="fa fa-print"></i> <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ setActive('admin/report/prodi') }}">
                                <a href="{{ route('admin.report.prodi') }}">
                                    <i class="fa fa-users"></i> <span>Per Prodi</span>
                                </a>
                            </li>
                            <li class="{{ setActive('admin/report/penerimaan') }}">
                                <a href="{{ route('admin.report.penerimaan') }}">
                                    <i class="fa fa-users"></i> <span>Penerimaan</span>
                                </a>
                            </li>
                        </ul>
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
