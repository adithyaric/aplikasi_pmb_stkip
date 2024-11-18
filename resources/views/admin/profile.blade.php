@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <h1>
            Profile
            <small>{{ $profile->name }}</small>
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
              
                   <form action="{{ route('profile.update',$profile->id) }}" method="post">
                    @csrf
                    @method("PUT")
                      
                       <div class="form-group @error('name') has-error @enderror">
                          <label for="exampleInputEmail1">Nama Lengkap</label>
                          <input type="text" class="form-control" name="name" value="{{ old('name',$profile->name) }}" placeholder="Masukan Nama lengkap">
                          @error('name')
                          <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group @error('email') has-error @enderror">
                         <label for="exampleInputPassword1">Email</label>
                         <input type="text" class="form-control " name="email" value="{{ old('email',$profile->email) }}"  placeholder="Masukan email">
                         @error('email')
                         <span class="help-block">{{ $message }}</span>
                            @enderror

                       </div>
                       <div class="form-group @error('password') has-error @enderror">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control " name="password"  placeholder="Masukan Password">
                        @error('password')
                        <span class="help-block">{{ $message }}</span>
                           @enderror

                      </div>
                     
                      <div class="form-group @error('password') has-error @enderror">
                        <label for="exampleInputPassword1">Password Confirmation</label>
                        <input type="password" class="form-control " name="password_confirmation"  placeholder="Masukan Password">
                        @error('password')
                        <span class="help-block">{{ $message }}</span>
                           @enderror

                      </div>
                       <button type="submit" class="btn btn-primary">Update Data</button>
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

