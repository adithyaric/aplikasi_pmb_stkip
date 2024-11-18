@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <h1>
            Create
            <small>Mahasiswa</small>
          </h1>
    </div>
   
  </section>
  <section class="content">
   <div class="container">
    <div class="row">
        <div class="col-xs-12">
            
  
          <div class="box container">
            
            <!-- /.box-header -->
            <div class="box-body">
              
                   <form action="{{ route('admin.mahasiswa.store') }}" method="post">
                    @csrf
                       <div class="form-group @error('nisn') has-error @enderror">
                         <label for="exampleInputEmail1">NISN</label>
                         <input type="number" class="form-control " value="{{ old('nisn') }}"  name="nisn" placeholder="Masukan Nisn">
                         @error('nisn')
                         <span class="help-block">{{ $message }}</span>
                        @enderror
                       </div>
                       <div class="form-group @error('name') has-error @enderror">
                          <label for="exampleInputEmail1">Nama Lengkap</label>
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Masukan Nama lengkap">
                          @error('name')
                          <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group @error('tempat_lahir') has-error @enderror">
                         <label for="exampleInputPassword1">Tempat Lahir</label>
                         <input type="text" class="form-control " name="tempat_lahir" value="{{ old('tempat_lahir') }}"  placeholder="Masukan Tempat lahir">
                         @error('tempat_lahir')
                         <span class="help-block">{{ $message }}</span>
                            @enderror

                       </div>
                       <div class="form-group @error('tanggal_lahir') has-error @enderror">
                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                        <input type="date" class="form-control " name="tanggal_lahir"  value="{{ old('tanggal_lahir') }}" placeholder="Masukan Tempat lahir">
                        @error('tanggal_lahir')
                        <span class="help-block">{{ $message }}</span>
                        @enderror

                      </div>
                      <div class="form-group @error('phone') has-error @enderror ">
                        <label for="exampleInputPassword1">No Hp</label>
                        <input type="number" class="form-control " name="phone" value="{{ old('phone') }}" placeholder="Masukan Tempat lahir">
                        @error('phone')
                        <span class="help-block">{{ $message }}</span>
                        
                        @enderror
                      </div>
                       <button type="submit" class="btn btn-primary">Daftar Mahasiswa</button>
                     </form>
                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
   </div>
    <!-- /.row -->
  </section>

@endsection

