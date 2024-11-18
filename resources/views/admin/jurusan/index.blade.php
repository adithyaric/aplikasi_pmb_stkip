@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
      Dashboard
      <small>Jurusan</small>
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
              
            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default" class="btn btn-primary">
                <i class="fa fa-plus"></i> Jurusan
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
            
              <tbody>
            </tbody>
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
          <h4 class="modal-title">Tambah Jurusan</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.jurusan.store') }}" method="post">
                @csrf
                   <div class="form-group @error('nisn') has-error @enderror">
                     <label for="exampleInputEmail1">Jurusan</label>
                     <input type="text" class="form-control " required name="name" placeholder="Masukan Jurusan">
                     
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
          <h4 class="modal-title">Edit Jurusan</h4>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.jurusan.store') }}" method="post">
                @csrf
                   <div class="form-group @error('nisn') has-error @enderror">
                     <label for="exampleInputEmail1">Jurusan</label>
                     <input type="text" class="form-control " required name="name" id="name" placeholder="Masukan Jurusan">
                     <input type="hidden" class="form-control " required name="id" id="id" placeholder="Masukan Jurusan">
                     
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
    $(function () {
      
        let datatable = $('.mahasiswa-datatable').DataTable({
          'autoWidth'   : false,
          'lengthChange': false,
          processing: true,
          serverSide: true,
          ajax: "{!! url()->current() !!}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
             
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
 function Edit(id)
        {
            $.ajax({
                url: 'jurusan/'+id + '/edit',
                dataType: 'json',
                type: 'get',
                success: function(hasil) {
                $('#name').val(hasil.data.name)
                $('#id').val(hasil.data.id)
                   
                $('#modal-edit').modal('show')
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