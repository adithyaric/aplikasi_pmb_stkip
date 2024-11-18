@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <h1>
            Edit
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
              
                   <form action="{{ route('admin.mahasiswa.update',$mahasiswa->id) }}" method="post">
                    @csrf
                    @method("PUT")
                       <div class="form-group @error('nisn') has-error @enderror">
                         <label for="exampleInputEmail1">NISN</label>
                         <input type="number" class="form-control " value="{{ old('nisn',$mahasiswa->nisn) }}" name="nisn"  placeholder="Masukan Nisn">
                         @error('nisn')
                         <span class="help-block">{{ $message }}</span>
                        @enderror
                       </div>
                       <div class="form-group @error('name') has-error @enderror">
                          <label for="exampleInputEmail1">Nama Lengkap</label>
                          <input type="text" class="form-control" name="name" value="{{ old('name',$mahasiswa->name) }}" placeholder="Masukan Nama lengkap">
                          @error('name')
                          <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group @error('tempat_lahir') has-error @enderror">
                         <label for="exampleInputPassword1">Tempat Lahir</label>
                         <input type="text" class="form-control " name="tempat_lahir" value="{{ old('tempat_lahir',$mahasiswa->mahasiswa->tempat_lahir) }}"  placeholder="Masukan Tempat lahir">
                         @error('tempat_lahir')
                         <span class="help-block">{{ $message }}</span>
                            @enderror

                       </div>
                       <div class="form-group @error('tanggal_lahir') has-error @enderror">
                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                        <input type="date" class="form-control " name="tanggal_lahir" value="{{ old('tempat_lahir',$mahasiswa->mahasiswa->tanggal_lahir) }}" placeholder="Masukan Tempat lahir">
                        @error('tanggal_lahir')
                        <span class="help-block">{{ $message }}</span>
                        @enderror

                      </div>
                      <div class="form-group @error('phone') has-error @enderror ">
                        <label for="exampleInputPassword1">No Hp</label>
                        <input type="number" class="form-control " name="phone" value="{{ old('tempat_lahir',$mahasiswa->mahasiswa->phone) }}" placeholder="Masukan Tempat lahir">
                        @error('phone')
                        <span class="help-block">{{ $message }}</span>
                        
                        @enderror
                      </div>
                      <div class="form-group @error('status') has-error @enderror ">
                        <label for="exampleInputPassword1">Status</label>
                        <select name="status" class="form-control" id="">
                          <option value="">Pilih Status</option>
                          <option value="DALAM PROSES" {{ $mahasiswa->mahasiswa->status == "DALAM PROSES" ? "selected" : "" }}>DALAM PROSES</option>
                          <option value="BAYAR OK {{ $mahasiswa->mahasiswa->status == "BAYAR OK" ? "selected" : "" }}">BAYAR OK</option>
                          <option value="BERKAS LENGKAP" {{ $mahasiswa->mahasiswa->status == "BERKAS LENGKAP" ? "selected" : "" }}>BERKAS LENGKAP</option>
                          <option value="TES / CBT" {{ $mahasiswa->mahasiswa->status == "TES / CBT" ? "selected" : "" }}>TES / CBT</option>
                          <option value="INTERVIEW" {{ $mahasiswa->mahasiswa->status == "INTERVIEW" ? "selected" : "" }}>INTERVIEW</option>
                          <option value="KELUAR" {{ $mahasiswa->mahasiswa->status == "KELUAR" ? "selected" : "" }}>KELUAR</option>
                        </select>
                        @error('status')
                        <span class="help-block">{{ $message }}</span>
                        
                        @enderror
                      </div>
                       <button type="submit" class="btn btn-primary">Edit Mahasiswa</button>
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

