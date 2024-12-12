@extends('layouts.mahasiswa')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Mahasiswa</small>
        </h1>
    </section>
    @if ($mahasiswa->status == 'TES / CBT' || $mahasiswa == 'INTERVIEW')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @foreach ($announcements as $announcement)
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible">
                            <h5>{{ $announcement->title }}</h5>
                            <p>{!! $announcement->content !!}</p>
                        </div>
                    </div>
                    <!-- ./col -->
                @endforeach
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>Hai, {{ Auth::user()->name }} !</h5>Pantau Terus Aplikasi Ini Untuk Mendapatkan Informasi
                        Terkini
                        Terkait PMB STKIP PGRI Pacitan<br>
                        Status pendaftaran kamu saat ini : &nbsp;
                        <span class="badge badge-default p-3">{{ Auth::user()->mahasiswa->status }}</span>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body text-center">
                            <h5>Foto Mahasiswa</h5>
                            <hr>
                            @if (Auth::user()->photo)
                                <img src="{{ Storage::url(Auth::user()->photo) }}" class="w-100"
                                    style="width:150px; height:150px" alt="">
                                <br>
                            @else
                                <img src="{{ asset('assets/img/default.jpg') }}" class="w-100"
                                    style="width:150px; height:150px" alt="">
                                <br>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body">
                            <b>
                                <h5>Rincian Data Pendaftar</h5>
                            </b>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="50%">Nama Pendaftar</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->biodata->tempat_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->biodata->tanggal_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->nisn }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row (main row) -->
        </section>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Photo Profile</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('changePhoto') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" required name="photo">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-left"> Kirim</button>
                                <button type="button" class="btn btn-default pull-right"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @else
        <section class="content">
            <div class="row">
                @foreach ($announcements as $announcement)
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible">
                            <h5>{{ $announcement->title }}</h5>
                            <p>{!! $announcement->content !!}</p>
                        </div>
                    </div>
                    <!-- ./col -->
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>Hai, {{ Auth::user()->name }} !</h5>Pantau Terus Aplikasi Ini Untuk Mendapatkan Informasi
                        Terkini
                        Terkait PMB STKIP PGRI Pacitan<br>
                        Status pendaftaran kamu saat ini : &nbsp; <span
                            class="badge badge-default p-3">{{ Auth::user()->mahasiswa->status }}</span>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-info text-center">
                        <h5>PILIH JALUR & UPLOAD BERKAS</h5>
                        <a href="{{ url('mahasiswa/data') }}" class="btn btn-danger">Klik Disini</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-4">
                    <div class="alert alert-warning text-center">
                        <h5>ISI BIODATA</h5>
                        <a href="{{ url('mahasiswa/biodata') }}" class="btn btn-danger">Klik Disini</a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-md-4">
                    <div class="alert alert-success text-center">
                        <h5>VERIFIKASI & CETAK KARTU</h5>
                        <a href="{{ url('mahasiswa/cetak') }}" class="btn btn-danger">Klik Disini</a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body text-center">
                            <h5>Foto Mahasiswa</h5>
                            <hr>
                            @if (Auth::user()->photo)
                                <img src="{{ Storage::url(Auth::user()->photo) }}" class="w-100"
                                    style="width:150px; height:150px" alt="">
                                <br>
                            @else
                                <img src="{{ asset('assets/img/default.jpg') }}" class="w-100"
                                    style="width:150px; height:150px" alt="">
                                <br>
                            @endif
                            <br>
                            <button type="button" class="btn  btn-warning" data-toggle="modal"
                                data-target="#modal-default">Change Foto</button>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-body">
                            <b>
                                <h5>Rincian Data Pendaftar</h5>
                            </b>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="50%">Nama Pendaftar</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->mahasiswa->tempat_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->mahasiswa->tanggal_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td>:</td>
                                            <td>{{ Auth::user()->nisn }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Photo Profile</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('changePhoto') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" required name="photo">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-left"> Kirim</button>
                                <button type="button" class="btn btn-default pull-right"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endsection
@endif
