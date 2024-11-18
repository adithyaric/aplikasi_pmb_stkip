@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Laporan
        <small>Per kelas</small>
    </h1>
    {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol> --}}
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="jalur" id="jalur" class="form-control" required>
                                    <option value="" readonly>-- Pilih Kelas --</option>
                                    <option value="REGULER" {{ request('jalur') == 'REGULER' ? 'selected' : ''  }}>
                                        REGULER</option>
                                    <option value="EKSEKUTIF" {{ request('jalur') == 'EKSEKUTIF' ? 'selected' : ''  }}>
                                        EKSEKUTIF</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-default">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if (request('jalur'))

                    Total Data :&nbsp; <b>{{ $mahasiswa->count() }}</b>

                    @if ($mahasiswa->count())
                    <hr style="margin: 6px;">

                    <a href="{{ route('admin.report.jalur_pdf', ['jalur' => request('jalur')]) }}" target="__blank"
                        class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak PDF</a>

                    <br>
                    <br>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th>NISN</th>
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $index => $key)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $key->nisn }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->mahasiswa->jurusan->name }}</td>
                                <td>{{ $key->mahasiswa->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @endif

                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

@endsection

@push('addon-script')

@endpush
