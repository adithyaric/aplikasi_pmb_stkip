@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Persyaratan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
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
                            <i class="fa fa-plus"></i> Persyaratan
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped mahasiswa-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>slug/kolom</th>
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
                    <h4 class="modal-title">Tambah Persyaratan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.persyaratan.store') }}" method="post">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Persyaratan</label>
                            <input type="text" class="form-control" required name="name"
                                placeholder="Masukan Persyaratan">
                            <label for="slug"><i>kolom</i></label>
                            <input type="text" class="form-control" name="slug" placeholder="Masukan Persyaratan">
                        </div>

                        <div class="form-group">
                            <label>Is Required</label><br>
                            <label><input type="radio" name="is_required" value="1" checked> Yes</label>
                            <label><input type="radio" name="is_required" value="0"> No</label>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left">Kirim</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Persyaratan</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.persyaratan.store') }}" method="post">
                        @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Persyaratan</label>
                            <input type="text" class="form-control" required name="name" id="name"
                                placeholder="Masukan Persyaratan">
                            <label for="slug"><i>kolom</i></label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                placeholder="Masukan Persyaratan">
                            <input type="hidden" name="id" id="id">
                        </div>

                        <div class="form-group">
                            <label>Is Required</label><br>
                            <label><input type="radio" name="is_required" value="1" id="is_required_yes"> Yes</label>
                            <label><input type="radio" name="is_required" value="0" id="is_required_no"> No</label>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-left">Kirim</button>
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });

        //aksi show modal edit
        function Edit(id) {
            $.ajax({
                url: 'persyaratan/' + id + '/edit',
                dataType: 'json',
                type: 'get',
                success: function(hasil) {
                    $('#name').val(hasil.data.name);
                    $('#slug').val(hasil.data.slug);
                    $('#id').val(hasil.data.id);

                    if (hasil.data.is_required) {
                        $('#is_required_yes').prop('checked', true);
                    } else {
                        $('#is_required_no').prop('checked', true);
                    }

                    $('#modal-edit').modal('show');
                }
            });
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
                    //ajax delete
                    jQuery.ajax({
                        url: "persyaratan/" + id,
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
