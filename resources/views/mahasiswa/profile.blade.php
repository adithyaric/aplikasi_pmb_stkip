@extends('layouts.mahasiswa')
@section('content')
<section class="content-header">
    <div class="container">
        <h1>
            Data Profile
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
                        <div class="row">
                            <div class="col-md-7">
                                <form action="{{ route('update.profile.mahasiswa',$profile->id) }}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group @error('nisn') has-error @enderror">
                                        <label for="exampleInputEmail1">Nisn</label>
                                        <input type="text" class="form-control" name="nisn"
                                            value="{{ old('nisn',$profile->nisn) }}" placeholder="Masukan nisn">
                                        @error('nisn')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('name') has-error @enderror">
                                        <label for="exampleInputEmail1">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name',$profile->name) }}" placeholder="Masukan Nama lengkap">
                                        @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('tempat_lahir') has-error @enderror">
                                        <label for="exampleInputPassword1">Tempat Lahir</label>
                                        <input type="text" class="form-control " name="tempat_lahir"
                                            value="{{ old('tempat_lahir',$profile->mahasiswa->tempat_lahir) }}"
                                            placeholder="Masukan Tempat lahir">
                                        @error('tempat_lahir')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group @error('tanggal_lahir') has-error @enderror">
                                        <label for="exampleInputPassword1">Tanggal Lahir</label>
                                        <input type="date" class="form-control " name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir',$profile->mahasiswa->tanggal_lahir) }}"
                                            placeholder="Masukan Tempat lahir">
                                        @error('tanggal_lahir')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group @error('phone') has-error @enderror ">
                                        <label for="exampleInputPassword1">No Hp</label>
                                        <input type="number" class="form-control " name="phone"
                                            value="{{ old('phone',$profile->mahasiswa->phone) }}"
                                            placeholder="Masukan Tempat lahir">
                                        @error('phone')
                                        <span class="help-block">{{ $message }}</span>

                                        @enderror
                                    </div>
                                    <div class="form-group @error('email') has-error @enderror">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input type="text" class="form-control " name="email"
                                            value="{{ old('email',$profile->email) }}" placeholder="Masukan email">
                                        @error('email')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group @error('password') has-error @enderror">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control " name="password"
                                            placeholder="Masukan Password">
                                        @error('password')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group @error('password') has-error @enderror">
                                        <label for="exampleInputPassword1">Password Confirmation</label>
                                        <input type="password" class="form-control " name="password_confirmation"
                                            placeholder="Masukan Password">
                                        @error('password')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                </form>
                            </div>
                            <div class="col-md-3 text-center">
                                <br><br>
                                @if ( Auth::user()->photo)
                                <img src="{{ Storage::url( Auth::user()->photo) }}"
                                    class="img img-thumbnail img-responsive" style="width: 80%;" alt="">
                                @else
                                <img src="{{ asset('assets/img/default.jpg') }}"
                                    class="img img-thumbnail img-responsive" style="width: 80%;" alt="">
                                @endif
                            </div>
                        </div>

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
