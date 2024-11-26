@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Gelombang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gelombang</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default"
                        class="btn btn-primary">
                        <i class="fa fa-plus"></i> Gelombang
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped mahasiswa-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Tahun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Gelombang</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.gelombang.store') }}" method="post">
                    @csrf
                    <div class="form-group @error('nisn') has-error @enderror">
                        <label for="exampleInputEmail1">Gelombang</label>
                        <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control"
                            required name="nama" placeholder="Masukkan Gelombang">
                        <label for="exampleInputEmail1">Biaya Pendaftaran</label>
                        <input type="number" class="form-control" required name="nominal"
                            placeholder="Masukkan Nominal">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        <select name="tahun_id" id="" class="mt-1 form-control" required>
                            <option value="" readonly>-- Pilih Tahun --</option>
                            @foreach ($tahuns as $tahun)
                            <option value="{{ $tahun->id }}">{{ $tahun->status ? 'aktif' : 'non-aktif' }}: {{ $tahun->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-left"> Kirim</button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Gelombang</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.gelombang.store') }}" method="post">
                    @csrf
                    <div class="form-group @error('nisn') has-error @enderror">
                        <label for="exampleInputEmail1">Gelombang</label>
                        <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control"
                            required name="nama" id="nama" placeholder="Masukan Gelombang">
                        <input type="hidden" class="form-control" required name="id" id="id"
                            placeholder="Masukan Gelombang">
                        <label for="exampleInputEmail1">Biaya Pendaftaran</label>
                        <input type="text" class="form-control" required name="nominal" id="nominal"
                            placeholder="Masukan Nominal">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        <label for="exampleInputPassword1">Tahun</label>
                        <select name="tahun_id" id="tahun_id" class="mt-1 form-control" required>
                            <option value="" readonly>-- Pilih Tahun --</option>
                            @foreach ($tahuns as $tahun)
                            <option value="{{ $tahun->id }}">{{ $tahun->status ? 'aktif' : 'non-aktif' }}: {{ $tahun->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-left"> Kirim</button>
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@push('addon-script')
<script type="text/javascript">
    $(function() {
        let datatable = $('.mahasiswa-datatable').DataTable({
            'autoWidth': false,
            'lengthChange': false,
            processing: true,
            serverSide: true,
            ajax: "{!! url()->current() !!}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama' },
                { data: 'nominal', name: 'nominal' },
                { data: 'status', name: 'status' },
                { data: 'tahun_name', name: 'tahun.name', title: 'Tahun' },
                { data: 'tahun_status', name: 'tahun.status', title: 'Tahun Status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    //aksi show modal edit
    function Edit(id) {
        $.ajax({
            url: 'gelombang/' + id + '/edit',
            dataType: 'json',
            type: 'get',
            success: function(hasil) {
                $('#nama').val(hasil.data.nama)
                $('#id').val(hasil.data.id)
                $('#nominal').val(hasil.data.nominal)
                $('#status').val(hasil.data.status)
                $('#tahun_id').val(hasil.data.tahun_id).change()
                $('#modal-edit').modal('show')
            }
        })
    }
    //aksi delete
    function Delete(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN ?",
            text: "INGIN MENGHAPUS DATA INI!",
            icon: "warning",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                jQuery.ajax({
                    url: "gelombang/" + id,
                    data: {
                        id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function(response) {
                        if (response) {
                            swal({
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIHAPUS!',
                                icon: 'success',
                                timer: 3000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: 'GAGAL!',
                                text: 'DATA GAGAL DIHAPUS!',
                                icon: 'error',
                                timer: 3000,
                                showConfirmButton: false,
                                showCancelButton: false,
                                buttons: false,
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            } else {
                return true;
            }
        })
    }
</script>
@endpush
