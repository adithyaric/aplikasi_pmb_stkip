@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Pengumuman</small>
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
                        <i class="fa fa-plus"></i> Pengumuman
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped mahasiswa-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
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
                <h4 class="modal-title">Tambah Pengumuman</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.pengumuman.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">Pengumuman</label>
                        <input type="text" class="form-control" required name="title" id="title"
                            placeholder="Masukan Pengumuman">
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Pengumuman</label>
                        <div id="editor-container"></div>
                        <input type="hidden" name="content" id="content">
                    </div>
                    <div class="form-group">
                        <label for="date_start">Tanggal Mulai</label>
                        <input type="text" class="form-control" required name="date_start" id="date_start">
                    </div>
                    <div class="form-group">
                        <label for="date_end">Tanggal Berakhir</label>
                        <input type="text" class="form-control" required name="date_end" id="date_end">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary pull-left">Kirim</button>
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
                <h4 class="modal-title">Edit Pengumuman</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.pengumuman.store') }}" method="post">
                    @csrf
                    <div class="form-group @error('title') has-error @enderror">
                        <label for="title">Pengumuman</label>
                        <input type="text" class="form-control" required name="title" id="edit-title"
                            placeholder="Masukan Pengumuman">
                        <input type="hidden" class="form-control" required name="id" id="id">
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Pengumuman</label>
                        <div id="editor-container-edit" style="height: 200px;"></div>
                        <input type="hidden" name="content" id="content-edit">
                    </div>
                    <div class="form-group">
                        <label for="date_start">Tanggal Mulai</label>
                        <input type="text" class="form-control" required name="date_start" id="edit-date_start">
                    </div>
                    <div class="form-group">
                        <label for="date_end">Tanggal Berakhir</label>
                        <input type="text" class="form-control" required name="date_end" id="edit-date_end">
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
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
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
                    data: 'title',
                    name: 'title'
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

    // Initialize Quill for the edit modal
    var quillEdit = new Quill('#editor-container-edit', {
        theme: 'snow'
    });

    //aksi show modal edit
    // function Edit(id) {
    //     $.ajax({
    //         url: 'pengumuman/' + id + '/edit',
    //         dataType: 'json',
    //         type: 'get',
    //         success: function(hasil) {
    //             // Populate fields
    //             $('#edit-title').val(hasil.data.title);
    //             $('#edit-date_start').val(hasil.data.date_start);
    //             $('#edit-date_end').val(hasil.data.date_end);
    //             $('#id').val(hasil.data.id);

    //             // Populate Quill editor
    //             quillEdit.root.innerHTML = hasil.data.content;

    //             // Open the modal after all fields are populated
    //             $('#modal-edit').modal('show');
    //         }
    //     });
    // }

        // On form submit, set Quill content to the hidden input
        $('#modal-edit form').on('submit', function(e) {
            $('#content-edit').val(quillEdit.root.innerHTML);
        });

        // Expose Edit function globally
        window.Edit = Edit;
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
                    url: "pengumuman/" + id,
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
<script type="text/javascript">
    // Initialize Quill
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    $('form').on('submit', function(e) {
        $('#content').val(quill.root.innerHTML); // Get Quill editor content
    });

    // Initialize Date Range Picker
    $('input[name="date_start"], input[name="date_end"]').daterangepicker({
        autoApply: true,
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('input[name="date_start"], input[name="date_end"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });
</script>
@endpush
