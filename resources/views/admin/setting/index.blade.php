@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <h1>Web Settings</h1>
    </div>

</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box container">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('admin.setting.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $setting?->id }}">

                            <div class="form-group @error('tahun_id') has-error @enderror">
                                <label for="tahun_id">Tahun Aktif</label>
                                {{-- <input type="text" class="form-control" id="tahun_aktif" name="tahun_aktif" value="{{ old('tahun_aktif', $setting?->tahun_aktif) }}" placeholder="Masukan Tahun Aktif"> --}}
                                <select name="tahun_id" id="tahun_id" class="form-control" required>
                                    <option value="" readonly>-- Pilih Tahun --</option>
                                    @foreach ($tahuns as $tahun)
                                    <option value="{{ $tahun->id }}" {{ request('tahun_id', $tahunAktif?->id) == $tahun->id ? 'selected' : '' }}>{{ $tahun->status ? 'aktif' : 'non-aktif' }}: {{ $tahun->nama }}</option>
                                    @endforeach
                                </select>
                                @error('tahun_id')<span class="help-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group @error('photo_front') has-error @enderror">
                                <label for="photo_front">Photo Front</label>
                                <input type="file" class="form-control" id="photo_front" name="photo_front"
                                    accept="image/*">
                                @error('photo_front')<span class="help-block">{{ $message }}</span>@enderror
                                @isset($setting->photo_front)
                                <img src="{{ asset('storage/' . $setting->photo_front) }}" alt="Photo Front" width="100"
                                    class="mt-2">
                                @endisset
                            </div>

                            <div class="form-group @error('photo_login') has-error @enderror">
                                <label for="photo_login">Photo Login</label>
                                <input type="file" class="form-control" id="photo_login" name="photo_login"
                                    accept="image/*">
                                @error('photo_login')<span class="help-block">{{ $message }}</span>@enderror
                                @isset($setting->photo_login)
                                <img src="{{ asset('storage/' . $setting->photo_login) }}" alt="Photo Login" width="100"
                                    class="mt-2">
                                @endisset
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
