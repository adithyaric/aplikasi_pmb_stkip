@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Transaction</small>
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
                    <a href="javascript:void(0)" data-toggle="modal" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Transaction
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped mahasiswa-datatable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Nominal</th>
                                <th>No Transaksi</th>
                                <th>No Briva</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button id="bulkBayar" class="btn btn-success">Bayar</button>
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
<script type="text/javascript">
$(function () {
    let datatable = $('.mahasiswa-datatable').DataTable({
        'autoWidth': false,
        'lengthChange': false,
        processing: true,
        serverSide: true,
        ajax: "{!! url()->current() !!}",
        columns: [
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false,
                render: function (data) {
                    return `<input type="checkbox" class="row-checkbox" value="${data}">`;
                }
            },
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user.name', name: 'name'},
            {data: 'nominal', name: 'nominal'},
            {data: 'no_transaksi', name: 'no_transaksi'},
            {data: 'briva', name: 'briva'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

    // Function to toggle the visibility of the button
    function toggleBulkBayarButton() {
        const anyChecked = $('.row-checkbox:checked').length > 0;
        $('#bulkBayar').toggle(anyChecked); // Show/Hide the button
    }

    // Check/Uncheck all rows
    $('#checkAll').on('click', function () {
        $('.row-checkbox').prop('checked', this.checked);
        toggleBulkBayarButton(); // Update button visibility
    });

    // Handle row checkbox change
    $(document).on('change', '.row-checkbox', function () {
        toggleBulkBayarButton(); // Update button visibility
    });

    // Handle bulk "Bayar" action
    $('#bulkBayar').on('click', function () {
        let selectedIds = [];
        $('.row-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            swal("Warning", "No rows selected!", "warning");
            return;
        }

        var token = $("meta[name='csrf-token']").attr("content");

        swal({
            title: "APAKAH KAMU YAKIN?",
            text: "INGIN MEMBAYAR DATA YANG DIPILIH!",
            icon: "info",
            buttons: [
                'TIDAK',
                'YA'
            ],
            dangerMode: true,
        }).then(function (isConfirm) {
            if (isConfirm) {
                console.log(selectedIds);

                $.ajax({
                    url: "{{ route('transaction.bulkUpdate') }}",
                    // url: "bulk",
                    type: "PUT",
                    data: {
                        ids: selectedIds,
                        "_token": token
                    },
                    success: function (response) {
                        if (response.success) {
                            swal("BERHASIL!", response.message, "success").then(function () {
                                location.reload();
                            });
                        } else {
                            swal("GAGAL!", response.message, "error");
                        }
                    }
                });
            }
        });
    });

    // Initial hide of the button
    $('#bulkBayar').hide();
});

//aksi show modal edit
function Edit(id)
{
    var id = id;
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
        title: "APAKAH KAMU YAKIN ?",
        text: "INGIN MEMBAYAR DATA INI!",
        icon: "info",
        buttons: [
            'TIDAK',
            'YA'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {

            //ajax delete
            jQuery.ajax({
                url: "transaction/"+id,
                data:   {
                    id,
                    "_token": token
                },
                type: 'PUT',
                success: function (response) {
                    if (response) {
                        swal({
                            title: 'BERHASIL!',
                            text: 'DATA BERHASIL DIUPDATE!',
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false,
                            showCancelButton: false,
                            buttons: false,
                        }).then(function() {
                            location.reload();
                        });

                    }else{
                        swal({
                            title: 'GAGAL!',
                            text: 'DATA GAGAL DIUPDATE!',
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
//aksi delete
function Delete(id)
{
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
                url: "jurusan/"+id,
                data:   {
                    id,
                    "_token": token
                },
                type: 'DELETE',
                success: function (response) {
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

                    }else{
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
