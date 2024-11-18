@extends('layouts.mahasiswa')
@section('content')
<section class="content">
     <div class="row">
             
   
           <div class="box">
             
             <!-- /.box-header -->
             <div class="box-body">
               
              <form class="form-horizontal">
                <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kartu Keluarga
                    </label>
  
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">NISN</label>
  
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Bukti Pembayaran</label>
  
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="inputPassword3" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-2">

                    </div>
                    
                    
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info ">Sign in</button>
                      {{-- <input type="file" class="form-control" id="inputPassword3" placeholder="Password"> --}}
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
                <!-- /.box-footer -->
              </form>
                 
             </div>
             <!-- /.box-body -->
           </div>
           <!-- /.box -->
         <!-- /.col -->
    </div>
     <!-- /.row -->
   </section>
@endsection