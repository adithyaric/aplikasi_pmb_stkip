@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Laporan
        <small>Per Jalur Penerimaan</small>
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
                                <select name="penerimaan_id" id="penerimaan_id" class="form-control" required>
                                    <option value="" readonly>-- Pilih Jalur Penerimaan --</option>
                                    @foreach ($penerimaan as $key)
                                    <option value="{{ $key->id }}" {{ request('penerimaan_id') == $key->id 
                                        ? 'selected' : '' }}>
                                        {{ $key->name }}</option>
                                    @endforeach
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
                    @if (request('penerimaan_id'))

                    Total Data :&nbsp; <b>{{ $mahasiswa->count() }}</b>

                    @if ($mahasiswa->count())
                    <hr style="margin: 6px;">

                    <a href="{{ route('admin.report.penerimaan_pdf', ['penerimaan_id' => request('penerimaan_id')]) }}"
                        target="__blank" class="btn btn-default pull-right"><i class="fa fa-print"></i> Cetak PDF</a>

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
