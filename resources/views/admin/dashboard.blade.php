@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form action="">
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <select name="tahun_id" id="" class="mb-3 form-control" required>
                    <option value="" readonly>-- Pilih Tahun --</option>
                    @foreach ($tahuns as $tahun)
                    <option value="{{ $tahun->id }}" {{ ($tahunId == $tahun->id || request('tahun_id') == $tahun->id) ? 'selected' : '' }} >{{ $tahun->status ? 'aktif' : 'non-aktif' }}: {{ $tahun->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6 col-xs-6">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form><br>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua-gradient">
                <div class="inner">
                    <h3>{{ $diterima }}</h3>
                    <p>Mahasiswa Diterima</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-android-checkmark-circle"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green-gradient">
                <div class="inner">
                    <h3>{{ $berkas }}</h3>
                    <p>Berkas Lengkap</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-android-document"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <h3>{{ $bayar }}</h3>
                    <p>Mahasiswa Bayar</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-cash"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-black-gradient">
                <div class="inner">
                    <h3>{{ $mahasiswa }}</h3>
                    <p>Pendaftaran Mahasiswa</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-clipboard"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green-gradient">
                <div class="inner">
                    <h3>{{ $cbt }}</h3>
                    <p>Mahasiswa TES / CBT</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-compose"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red-gradient">
                <div class="inner">
                    <h3>{{ $interview }}</h3>
                    <p>Mahasiswa Interview</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-ios-flag-outline"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-black-gradient">
                <div class="inner">
                    <h3>{{ $keluar }}</h3>
                    <p>Mahasiswa Keluar</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-clipboard"></i> --}}
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <hr style="border: 1px solid black;">
            <h4>PER GELOMBANG</h4>
        </div>
        @foreach ($gelombang as $key)
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="text-center">
                    <h3 style="margin-top: 3px !important;">
                        @isset($key->user)
                        {{ $key->user->count() }}
                        @endisset
                    </h3>
                    <hr style="margin-bottom: 3px !important;">
                    <p style="font-size: 10px;">{{ $key->nama }}</p>
                </div>
                <a href="{{ route('admin.gelombang.show', ['gelombang' => $key->id ]) }}" class="small-box-footer">Lihat
                    Selengkapnya &nbsp; <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-12">
            <hr style="border: 1px solid black;">
            <h4>PER PRODI</h4>
        </div>
        @foreach ($jurusan as $key)
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="text-center">
                    <h3 style="margin-top: 3px !important;">
                        {{ $key->mahasiswa->count() }}
                    </h3>
                    <hr style="margin-bottom: 3px !important;">
                    <p style="font-size: 10px;">{{ str_replace('PENDIDIKAN ', '', $key->name) }}</p>
                </div>
                <a href="{{ route('admin.report.prodi', ['jurusan_id' => $key->id, 'tahun_id' => $tahunId ]) }}" class="small-box-footer">
                    Lihat Selengkapnya &nbsp;
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        @endforeach
    </div>
    <!-- /.row (main row) -->
</section>
@endsection
