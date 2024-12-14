@extends('layouts.mahasiswa')
@section('content')

    <section class="content">
        <div class="container">
            @if ($mahasiswa->status == 'TES / CBT' || $mahasiswa->status == 'INTERVIEW')
                <div class="bd">
                    <article>
                        <h1 style="text-align: center;">SELAMAT</h1>
                        <div>
                            <h1 style="text-align: center;">DATA PENDAFTARAN ANDA TELAH DIVALIDASI OLEH PANITIA PMB DAN
                                SILAHKAN MENUNGGU INFORMASI UNTUK TAHAPAN TES SELEKSI SELANJUTNYA.</h1>
                            <p style="text-align: center;">&mdash; PMB STKIP PGRI PACITAN</p>
                        </div>
                    </article>
                </div>
            @else
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box container">
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <!-- Custom Tabs -->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="{{ request('active_tab') == 'tab_1' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_1']) }}" >BIODATA</a></li>
                                                <li class="{{ request('active_tab') == 'tab_2' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_2']) }}" >ALAMAT (Sesuai KTP)</a></li>
                                                <li class="{{ request('active_tab') == 'tab_3' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_3']) }}" >SEKOLAH / LULUSAN</a></li>
                                                <li class="{{ request('active_tab') == 'tab_4' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_4']) }}" >RENCANA</a></li>
                                                <li class="{{ request('active_tab') == 'tab_5' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_5']) }}" >DATA KELUARGA & KARTU</a></li>
                                                <li class="{{ request('active_tab') == 'tab_6' ? 'active' : '' }}"><a href="{{ route('biodata.index', ['active_tab' => 'tab_6']) }}" >PEMBERI REKOMENDASI</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane {{ request('active_tab') == 'tab_1' ? 'active' : 'hide' }}" id="tab_1">
                                                    <div class="box-body">
                                                        <i>
                                                            <strong class="blink" style="color: red !important;">
                                                                Isi Formulir Dengan Lengkap Hingga Formulir Pemberi
                                                                Rekomendasi dan Gunakan Huruf Besar!
                                                            </strong>
                                                        </i>
                                                        <hr>
                                                        <form action="{{ route('mahasiswa.create.biodata') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">                                                            <div class="form-group @error('nik') has-error @enderror">
                                                                <label for="exampleInputEmail1">NIK</label>
                                                                <input type="number" required class="form-control "
                                                                    value="{{ old('nik') ?? $biodata == null ? '' : $biodata->nik }}"
                                                                    name="nik" placeholder="Masukan NIK">
                                                                @error('nik')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('name') has-error @enderror">
                                                                <label for="exampleInputEmail1">Nama Lengkap (Sesuai KTP &
                                                                    Gunakan Huruf Kapital)</label>
                                                                <input type="text" class="form-control" required
                                                                    name="name"
                                                                    value="{{ old('name') ?? $biodata == null ? '' : $biodata->name }}"
                                                                    placeholder="Masukan Nama lengkap">
                                                                @error('name')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('jenis_kelamin') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Jenis Kelamin </label>
                                                                @if ($biodata)
                                                                    <select name="jenis_kelamin" class="form-control">
                                                                        <option value="LAKI LAKI"
                                                                            {{ $biodata->jenis_kelamin == 'LAKI-LAKI' ? 'selected' : '' }}>
                                                                            LAKI-LAKI</option>
                                                                        <option value="PEREMPUAN"
                                                                            {{ $biodata->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>
                                                                            PEREMPUAN</option>
                                                                    </select>
                                                                @else
                                                                    <select name="jenis_kelamin" class="form-control">
                                                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                                                    </select>
                                                                @endif
                                                                @error('jenis_kelamin')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('tempat_lahir') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Tempat Lahir</label>
                                                                <input type="text" class="form-control" required
                                                                    name="tempat_lahir"
                                                                    value="{{ old('tempat_lahir') ?? $biodata == null ? '' : $biodata->tempat_lahir }}"
                                                                    placeholder="Masukan Tempat lahir">
                                                                @error('tempat_lahir')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('tanggal_lahir') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Tanggal Lahir</label>
                                                                <input type="date" class="form-control "
                                                                    name="tanggal_lahir" required
                                                                    value="{{ old('tanggal_lahir') ?? $biodata == null ? '' : $biodata->tanggal_lahir }}"
                                                                    placeholder="Masukan Tanggal lahir">
                                                                @error('tanggal_lahir')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('agama') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Agama</label>
                                                                @if ($biodata)
                                                                    <select name="agama" class="form-control">
                                                                        <option value="ISLAM"
                                                                            {{ $biodata->agama == 'ISLAM' ? 'selected' : '' }}>
                                                                            ISLAM
                                                                        </option>
                                                                        <option value="KRISTEN PROTESTAN"
                                                                            {{ $biodata->agama == 'KRISTEN PROTESTAN' ? 'selected' : '' }}>
                                                                            KRISTEN PROTESTAN</option>
                                                                        <option value="KATOLIK"
                                                                            {{ $biodata->agama == 'KATOLIK' ? 'selected' : '' }}>
                                                                            KATOLIK</option>
                                                                        <option value="HINDU"
                                                                            {{ $biodata->agama == 'HINDU' ? 'selected' : '' }}>
                                                                            HINDU
                                                                        </option>
                                                                        <option value="BUDDHA"
                                                                            {{ $biodata->agama == 'BUDDHA' ? 'selected' : '' }}>
                                                                            BUDDHA
                                                                        </option>
                                                                        <option value="KONGHUCU"
                                                                            {{ $biodata->agama == 'KONGHUCU' ? 'selected' : '' }}>
                                                                            KONGHUCU
                                                                        </option>
                                                                    </select>
                                                                @else
                                                                    <select name="agama" class="form-control">
                                                                        <option value="ISLAM">ISLAM</option>
                                                                        <option value="KRISTEN">KRISTEN</option>
                                                                        <option value="KATOLIK">KATOLIK</option>
                                                                        <option value="HINDHU">HINDHU</option>
                                                                        <option value="BUDDHA">BUDDHA</option>
                                                                        <option value="KONGHUCU">KONGHUCU</option>
                                                                    </select>
                                                                @endif
                                                                @error('agama')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('anak') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Anak</label>
                                                                <input type="number" class="form-control" required
                                                                    name="anak"
                                                                    value="{{ old('anak') ?? $biodata == null ? '' : $biodata->anak }}"
                                                                    placeholder="Masukan Anak Ke berapa">
                                                                @error('anak')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('jumlah_saudara') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Jumlah Saudara </label>
                                                                <input type="number" class="form-control" required
                                                                    name="jumlah_saudara"
                                                                    value="{{ old('jumlah_saudara') ?? $biodata == null ? '' : $biodata->jumlah_saudara }}"
                                                                    placeholder="Masukan Jumlah Saudara">
                                                                @error('jumlah_saudara')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('status_sipil') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Status Kewarganegaraan
                                                                </label>
                                                                @if ($biodata)
                                                                    <select name="status_sipil" class="form-control">
                                                                        <option value="WNI"
                                                                            {{ $biodata->status_sipil == 'WNI' ? 'selected' : '' }}>
                                                                            WNI</option>
                                                                        <option value="WNA"
                                                                            {{ $biodata->status_sipil == 'WNA' ? 'selected' : '' }}>
                                                                            WNA</option>
                                                                    </select>
                                                                @else
                                                                    <select name="status_sipil" class="form-control">
                                                                        <option value="WNI">WNI</option>
                                                                        <option value="WNA">WNA</option>
                                                                    </select>
                                                                @endif
                                                                @error('status_sipil')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('phone') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Nomor Hp </label>
                                                                <input type="number" class="form-control " required
                                                                    name="phone"
                                                                    value="{{ old('phone') ?? $biodata == null ? '' : $biodata->phone }}"
                                                                    placeholder="Masukan Nomor Handphone">
                                                                @error('phone')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('phone_ortu') has-error @enderror">
                                                                <label for="phone_ortu">Nomor HP Orang Tua </label>
                                                                <input type="text" class="form-control "
                                                                    name="phone_ortu"
                                                                    value="{{ old('phone_ortu') ?? $biodata == null ? '' : $biodata->phone_ortu }}"
                                                                    placeholder="Nomor HP Orang Tua">
                                                                @error('phone_ortu')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('email') has-error @enderror ">
                                                                <label for="exampleInputPassword1">Email </label>
                                                                <input type="email" class="form-control " required
                                                                    name="email"
                                                                    value="{{ old('email') ?? $biodata == null ? '' : $biodata->email }}"
                                                                    placeholder="Masukan E-Mail">
                                                                @error('email')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <hr>
                                                            <strong style="color: red !important;"><i>Klik Simpan Lalu Klik Selanjutnya</i></strong>
                                                            <hr>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            <a href="{{ route('biodata.index', ['active_tab' => 'tab_2']) }}" class="btn btn-success">Selanjutnya</a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane {{ request('active_tab') == 'tab_2' ? 'active' : 'hide' }}" id="tab_2">
                                                    <div class="box-body">
                                                        <i>
                                                            <strong class="blink" style="color: red !important;">
                                                                Isi Formulir Dengan Lengkap Hingga Formulir Pemberi
                                                                Rekomendasi dan Gunakan Huruf Besar!
                                                            </strong>
                                                        </i>
                                                        <hr>
                                                        <form action="{{ route('mahasiswa.create.biodata') }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">                                                            <div class="form-group @error('RT') has-error @enderror">
                                                                <label for="exampleInputEmail1">RT</label>
                                                                <input type="number" class="form-control "
                                                                    value="{{ old('RT') ?? $alamat == null ? '' : $alamat->RT }}"
                                                                    name="RT" placeholder="Masukan RT" required>
                                                                @error('RT')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('RW') has-error @enderror">
                                                                <label for="exampleInputEmail1">RW </label>
                                                                <input type="text" required class="form-control"
                                                                    name="RW"
                                                                    value="{{ old('RW') ?? $alamat == null ? '' : $alamat->RW }}"
                                                                    placeholder="Masukan RW">
                                                                @error('RW')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('dusun') has-error @enderror">
                                                                <label for="exampleInputPassword1">DUSUN </label>
                                                                <input type="text" required class="form-control "
                                                                    name="dusun"
                                                                    value="{{ old('dusun') ?? $alamat == null ? '' : $alamat->dusun }}"
                                                                    placeholder="Masukan Dusun">
                                                                @error('dusun')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                            <div class="form-group @error('desa') has-error @enderror">
                                                                <label for="exampleInputPassword1">DESA </label>
                                                                <input type="text" required class="form-control "
                                                                    name="desa"
                                                                    value="{{ old('desa') ?? $alamat == null ? '' : $alamat->desa }}"
                                                                    placeholder="Masukan Desa">
                                                                @error('desa')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                            <div
                                                                class="form-group @error('kecamatan') has-error @enderror ">
                                                                <label for="exampleInputPassword1">KECAMATAN</label>
                                                                <input type="text" required class="form-control "
                                                                    name="kecamatan"
                                                                    value="{{ old('kecamatan') ?? $alamat == null ? '' : $alamat->kecamatan }}"
                                                                    placeholder="Masukan Kecamatan">
                                                                @error('kecamatan')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('kabupaten') has-error @enderror ">
                                                                <label for="exampleInputPassword1">KABUPATEN</label>
                                                                <input type="text" required class="form-control "
                                                                    name="kabupaten"
                                                                    value="{{ old('kabupaten') ?? $alamat == null ? '' : $alamat->kabupaten }}"
                                                                    placeholder="Masukan Kabupaten">
                                                                @error('kabupaten')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div
                                                                class="form-group @error('Provinsi') has-error @enderror ">
                                                                <label for="exampleInputPassword1">PROVINSI</label>
                                                                <input type="text" required class="form-control "
                                                                    name="provinsi"
                                                                    value="{{ old('Provinsi') ?? $alamat == null ? '' : $alamat->provinsi }}"
                                                                    placeholder="Masukan Provinsi">
                                                                @error('Provinsi')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group @error('jalan') has-error @enderror ">
                                                                <label for="exampleInputPassword1">ALAMAT LENGKAP </label>
                                                                <input type="text" required class="form-control "
                                                                    name="jalan"
                                                                    value="{{ old('jalan') ?? $alamat == null ? '' : $alamat->jalan }}"
                                                                    placeholder="RT / RW, DUSUN, DESA, KECAMATAN">
                                                                @error('jalan')
                                                                    <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <hr>
                                                            <strong style="color: red !important;"><i>Klik Simpan Lalu Klik Selanjutnya</i></strong>
                                                            <hr>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            <a href="{{ route('biodata.index', ['active_tab' => 'tab_3']) }}" class="btn btn-success">Selanjutnya</a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane {{ request('active_tab') == 'tab_3' ? 'active' : 'hide' }}" id="tab_3">
                                                    <i>
                                                        <strong class="blink" style="color: red !important;">
                                                            Isi Formulir Dengan Lengkap Hingga Formulir Pemberi Rekomendasi
                                                            dan Gunakan Huruf Besar!
                                                        </strong>
                                                    </i>
                                                    <hr>
                                                    <form action="{{ route('mahasiswa.create.biodata') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">
                                                        <div class="form-group @error('nisn') has-error @enderror">
                                                            <label for="exampleInputEmail1">NISN</label>
                                                            <input type="number" required class="form-control "
                                                                value="{{ old('nisn') ?? $lulusan == null ? '' : $lulusan->nisn }}"
                                                                name="nisn" placeholder="Masukan Nisn">
                                                            @error('nisn')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('name') has-error @enderror">
                                                            <label for="exampleInputEmail1">TAHUN LULUS </label>
                                                            <input type="number" required class="form-control"
                                                                name="tahun_lulus"
                                                                value="{{ old('tahun_lulus') ?? $lulusan == null ? '' : $lulusan->tahun_lulus }}"
                                                                placeholder="Masukan Tahun Lulus">
                                                            @error('tahun_lulus')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('asal_sekolah') has-error @enderror">
                                                            <label for="exampleInputPassword1">ASAL SEKOLAH </label>
                                                            <input type="text" required class="form-control "
                                                                name="asal_sekolah"
                                                                value="{{ old('asal_sekolah') ?? $lulusan == null ? '' : $lulusan->asal_sekolah }}"
                                                                placeholder="Masukan Asal Sekolah">
                                                            @error('asal_sekolah')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group @error('npsn') has-error @enderror">
                                                            <label for="exampleInputPassword1">NPSN </label>
                                                            <input type="number" required class="form-control "
                                                                name="npsn"
                                                                value="{{ old('npsn') ?? $lulusan == null ? '' : $lulusan->npsn }}"
                                                                placeholder="Masukan NPSN">
                                                            @error('npsn')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>

                                                        <div
                                                            class="form-group @error('alamat_sekolah') has-error @enderror">
                                                            <label for="exampleInputPassword1">ALAMAT SEKOLAH </label>
                                                            <input type="text" required class="form-control "
                                                                name="alamat_sekolah"
                                                                value="{{ old('alamat_sekolah') ?? $lulusan == null ? '' : $lulusan->alamat_sekolah }}"
                                                                placeholder="Masukan Alamat Sekolah">
                                                            @error('alamat_sekolah')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>

                                                        <div class="form-group @error('kab_sekolah') has-error @enderror">
                                                            <label for="exampleInputPassword1">KABUPATEN SEKOLAH </label>
                                                            <input type="text" required class="form-control "
                                                                name="kab_sekolah"
                                                                value="{{ old('kab_sekolah') ?? $lulusan == null ? '' : $lulusan->kab_sekolah }}"
                                                                placeholder="Masukan Kabupaten Sekolah">
                                                            @error('kab_sekolah')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>

                                                        <div
                                                            class="form-group @error('prov_sekolah') has-error @enderror">
                                                            <label for="exampleInputPassword1">PROVINSI SEKOLAH </label>
                                                            <input type="text" required class="form-control "
                                                                name="prov_sekolah"
                                                                value="{{ old('prov_sekolah') ?? $lulusan == null ? '' : $lulusan->prov_sekolah }}"
                                                                placeholder="Masukan Provinsi Sekolah">
                                                            @error('prov_sekolah')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>

                                                        <hr>
                                                        <strong style="color: red !important;"><i>Klik Simpan Lalu Klik Selanjutnya</i></strong>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <a href="{{ route('biodata.index', ['active_tab' => 'tab_4']) }}" class="btn btn-success">Selanjutnya</a>
                                                    </form>
                                                </div>
                                                <div class="tab-pane {{ request('active_tab') == 'tab_4' ? 'active' : 'hide' }}" id="tab_4">
                                                    <i>
                                                        <strong class="blink" style="color: red !important;">
                                                            Isi Formulir Dengan Lengkap Hingga Formulir Pemberi Rekomendasi
                                                            dan Gunakan Huruf Besar!
                                                        </strong>
                                                    </i>
                                                    <hr>
                                                    <form action="{{ route('mahasiswa.create.biodata') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">                                                        <div class="form-group @error('rencana') has-error @enderror">
                                                            <label for="exampleInputEmail1">RENCANA TINGGAL </label>
                                                            <input type="text" required class="form-control "
                                                                value="{{ old('rencana') ?? $rencana == null ? '' : $rencana->rencana_tinggal }}"
                                                                name="rencana_tinggal"
                                                                placeholder="Masukan Rencana Tinggal">
                                                            @error('rencana')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('transport') has-error @enderror">
                                                            <label for="exampleInputEmail1">ALAT TRANSPORTASI </label>
                                                            <input type="text" required class="form-control"
                                                                name="transport"
                                                                value="{{ old('transport') ?? $rencana == null ? '' : $rencana->transport }}"
                                                                placeholder="Masukan Transport">
                                                            @error('transport')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('jarak_tempuh') has-error @enderror">
                                                            <label for="exampleInputPassword1">JARAK TEMPUH </label>
                                                            <input type="text" required class="form-control "
                                                                name="jarak_tempuh"
                                                                value="{{ old('jarak_tempuh') ?? $rencana == null ? '' : $rencana->jarak_tempuh }}"
                                                                placeholder="Masukan Jarak Tempuh">
                                                            @error('jarak_tempuh')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div
                                                            class="form-group @error('asal_pembiayaan') has-error @enderror">
                                                            <label for="exampleInputPassword1">ASAL PEMBIAYAAN </label>
                                                            <input type="text" required class="form-control "
                                                                name="asal_pembiayaan"
                                                                value="{{ old('asal_pembiayaan') ?? $rencana == null ? '' : $rencana->asal_pembiayaan }}"
                                                                placeholder="Masukan Asal Pembiayaan">
                                                            @error('asal_pembiayaan')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>


                                                        <hr>
                                                        <strong style="color: red !important;"><i>Klik Simpan Lalu Klik Selanjutnya</i></strong>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <a href="{{ route('biodata.index', ['active_tab' => 'tab_5']) }}" class="btn btn-success">Selanjutnya</a>
                                                    </form>
                                                </div>
                                                <div class="tab-pane {{ request('active_tab') == 'tab_5' ? 'active' : 'hide' }}" id="tab_5">
                                                    <i>
                                                        <strong class="blink" style="color: red !important;">
                                                            Isi Formulir Dengan Lengkap Hingga Formulir Pemberi Rekomendasi
                                                            dan Gunakan Huruf Besar!
                                                        </strong>
                                                    </i>
                                                    <hr>
                                                    <form action="{{ route('mahasiswa.create.biodata') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">
                                                        <div class="form-group @error('noKK') has-error @enderror">
                                                            <label for="exampleInputEmail1">NO KK </label>
                                                            <input type="number" required class="form-control "
                                                                value="{{ old('noKK') ?? $pemilikkartu == null ? '' : $pemilikkartu->noKK }}"
                                                                name="noKK" placeholder="Masukan Nomor KK">
                                                            @error('noKK')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group @error('nama_kk') has-error @enderror">
                                                            <label for="exampleInputEmail1">NAMA AYAH </label>
                                                            <input type="text" required class="form-control"
                                                                name="nama_kk"
                                                                value="{{ old('nama_kk') ?? $pemilikkartu == null ? '' : $pemilikkartu->nama_kk }}"
                                                                placeholder="Masukan Nama Kepala Keluarga">
                                                            @error('nama_kk')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div
                                                            class="form-group @error('pekerjaan_ayah') has-error @enderror">
                                                            <label for="exampleInputEmail1">PEKERJAAN AYAH </label>
                                                            <input type="text" required class="form-control"
                                                                name="pekerjaan_ayah"
                                                                value="{{ old('pekerjaan_ayah') ?? $pemilikkartu == null ? '' : $pemilikkartu->pekerjaan_ayah }}"
                                                                placeholder="Masukan Pekerjaan Ayah">
                                                            @error('pekerjaan_ayah')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group @error('nama_ibu') has-error @enderror">
                                                            <label for="exampleInputEmail1">NAMA IBU </label>
                                                            <input type="text" required class="form-control"
                                                                name="nama_ibu"
                                                                value="{{ old('nama_ibu') ?? $pemilikkartu == null ? '' : $pemilikkartu->nama_ibu }}"
                                                                placeholder="Masukan Nama Ibu Kandung">
                                                            @error('nama_ibu')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div
                                                            class="form-group @error('pekerjaan_ibu') has-error @enderror">
                                                            <label for="exampleInputEmail1">PEKERJAAN IBU </label>
                                                            <input type="text" required class="form-control"
                                                                name="pekerjaan_ibu"
                                                                value="{{ old('pekerjaan_ibu') ?? $pemilikkartu == null ? '' : $pemilikkartu->pekerjaan_ibu }}"
                                                                placeholder="Masukan Pekerjaan Ayah">
                                                            @error('pekerjaan_ibu')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        {{-- <div class="form-group @error('phone_ortu') has-error @enderror"> --}}
                                                        {{-- <label for="phone_ortu">Nomor HP Orang Tua </label> --}}
                                                        {{-- <input type="text" class="form-control " name="phone_ortu" --}}
                                                        {{-- value="{{ old('phone_ortu')?? $biodata == null ? '' : $biodata->phone_ortu }}" --}}
                                                        {{-- placeholder="Nomor HP Orang Tua"> --}}
                                                        {{-- @error('phone_ortu') --}}
                                                        {{-- <span class="help-block">{{ $message }}</span> --}}
                                                        {{-- @enderror --}}
                                                        {{-- </div> --}}
                                                        @if(Auth::user()->mahasiswa->penerimaan_id == 1)
                                                        <hr><i><strong>Bagian Dibawah Ini Hanya Muncul Oleh Pendaftar Jalur KIP-Kuliah</strong></i>
                                                        <hr>
                                                        <div class="form-group @error('kip') has-error @enderror">
                                                            <label for="exampleInputPassword1">Nomor KIP (Jika ada)
                                                            </label>
                                                            <input type="text" class="form-control " name="kip"
                                                                value="{{ old('kip') ?? $pemilikkartu == null ? '' : $pemilikkartu->kip }}"
                                                                placeholder="Masukan KIP">
                                                            @error('kip')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group @error('np_kip') has-error @enderror">
                                                            <label for="exampleInputPassword1">Nomor Pendaftaran KIP-Kuliah
                                                                (Web Kemendikbud) <a
                                                                    href="https://kip-kuliah.kemdikbud.go.id/siswa/auth/login"
                                                                    target="_blank">Login KIP-Kuliah</a> </label>
                                                            <input type="text" class="form-control " name="np_kip"
                                                                value="{{ old('np_kip') ?? $pemilikkartu == null ? '' : $pemilikkartu->np_kip }}"
                                                                placeholder="Masukan Nomor Pendaftaran KIP">
                                                            @error('np_kip')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group @error('ka_kip') has-error @enderror">
                                                            <label for="exampleInputPassword1">Kode Akses KIP-Kuliah
                                                            </label>
                                                            <input type="text" class="form-control " name="ka_kip"
                                                                value="{{ old('ka_kip') ?? $pemilikkartu == null ? '' : $pemilikkartu->ka_kip }}"
                                                                placeholder="Masukan Kode Akses KIP">
                                                            @error('ka_kip')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group @error('kks') has-error @enderror">
                                                            <label for="exampleInputPassword1">Nomor KKS (Jika ada)
                                                            </label>
                                                            <input type="text" class="form-control " name="kks"
                                                                value="{{ old('kks') ?? $pemilikkartu == null ? '' : $pemilikkartu->kks }}"
                                                                placeholder="Masukan KKS">
                                                            @error('kks')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="form-group @error('pkh') has-error @enderror">
                                                            <label for="exampleInputPassword1">Nomor PKH (Jika ada)
                                                            </label>
                                                            <input type="text" class="form-control " name="pkh"
                                                                value="{{ old('pkh') ?? $pemilikkartu == null ? '' : $pemilikkartu->pkh }}"
                                                                placeholder="Masukan PKH">
                                                            @error('pkh')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        @endif

                                                        <hr>
                                                        <strong style="color: red !important;"><i>Klik Simpan Lalu Klik Selanjutnya</i></strong>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <a href="{{ route('biodata.index', ['active_tab' => 'tab_6']) }}" class="btn btn-success">Selanjutnya</a>
                                                    </form>
                                                </div>
                                                <div class="tab-pane {{ request('active_tab') == 'tab_6' ? 'active' : 'hide' }}" id="tab_6">
                                                    <i>
                                                        <strong style="color: red !important;">
                                                            Isi Formulir Dengan Lengkap Hingga Formulir Pemberi Rekomendasi
                                                            dan Gunakan Huruf Besar!
                                                        </strong>
                                                    </i>
                                                    <hr>
                                                    <form action="{{ route('mahasiswa.create.biodata') }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="active_tab" id="active_tab" value="{{ request('active_tab') }}">                                                        <div
                                                            class="form-group @error('pemberi_rekomendasi') has-error @enderror ">
                                                            <label for="exampleInputPassword1">Pemberi Rekomendasi </label>
                                                            @if ($biodata)
                                                                <select name="pemberi_rekomendasi" class="form-control">
                                                                    <option value="TIDAK ADA"
                                                                        {{ $biodata->pemberi_rekomendasi == 'TIDAK ADA' ? 'selected' : '' }}>
                                                                        TIDAK ADA</option>
                                                                    <option value="DOSEN"
                                                                        {{ $biodata->pemberi_rekomendasi == 'DOSEN' ? 'selected' : '' }}>
                                                                        DOSEN</option>
                                                                    <option value="MAHASISWA"
                                                                        {{ $biodata->pemberi_rekomendasi == 'MAHASISWA' ? 'selected' : '' }}>
                                                                        MAHASISWA</option>
                                                                    <option value="KARYAWAN"
                                                                        {{ $biodata->pemberi_rekomendasi == 'KARYAWAN' ? 'selected' : '' }}>
                                                                        KARYAWAN</option>
                                                                    <option value="ALUMNI"
                                                                        {{ $biodata->pemberi_rekomendasi == 'ALUMNI' ? 'selected' : '' }}>
                                                                        ALUMNI</option>
                                                                </select>
                                                            @else
                                                                <select name="pemberi_rekomendasi" class="form-control">
                                                                    <option value="TIDAK ADA">TIDAK ADA</option>
                                                                    <option value="DOSEN">DOSEN</option>
                                                                    <option value="MAHASISWA">MAHASISWA</option>
                                                                    <option value="KARYAWAN">KARYAWAN</option>
                                                                    <option value="ALUMNI">ALUMNI</option>
                                                                </select>
                                                            @endif
                                                            @error('pemberi_rekomendasi')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('nama_rekomendasi') has-error @enderror ">
                                                            <label for="exampleInputPassword1">Nama Perekom (Isi "-" Jika
                                                                Tidak
                                                                Ada)</label>
                                                            <input class="form-control" required name="nama_rekomendasi"
                                                                value="{{ old('email') ?? $biodata == null ? '' : $biodata->nama_rekomendasi }}"
                                                                type="text">
                                                            @error('nama_rekomendasi')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('wa_rekomendasi') has-error @enderror ">
                                                            <label for="exampleInputPassword1">Nomor Hp Perekom (Biarkan
                                                                Kosong Jika Tidak Ada Perekom) </label>
                                                            <input type="number" class="form-control "
                                                                name="wa_rekomendasi"
                                                                value="{{ old('wa_rekomendasi') ?? $biodata == null ? '' : $biodata->wa_rekomendasi }}"
                                                                placeholder="Masukan Nomor Handphone Perekom">
                                                            @error('wa_rekomendasi')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('prodi_perekom') has-error @enderror ">
                                                            <label for="exampleInputPassword1">Prodi Perekom (Jika Perekom
                                                                Adalah Mahasiswa)</label>
                                                            @if ($biodata)
                                                                <select name="prodi_perekom" class="form-control">
                                                                    <option value="" disabled selected>Pilih Jurusan
                                                                        / Program Studi</option>
                                                                    <option value="BUKAN MAHASISWA"
                                                                        {{ $biodata->prodi_perekom == 'BUKAN MAHASISWA' ? 'selected' : '' }}>
                                                                        BUKAN MAHASISWA
                                                                    </option>
                                                                    <option value="PENDIDIKAN GURU SEKOLAH DASAR"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN GURU SEKOLAH DASAR' ? 'selected' : '' }}>
                                                                        PENDIDIKAN GURU SEKOLAH DASAR
                                                                    </option>
                                                                    <option value="PENDIDIKAN BAHASA DAN SASTRA INDONESIA"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN BAHASA DAN SASTRA INDONESIA' ? 'selected' : '' }}>
                                                                        PENDIDIKAN BAHASA DAN SASTRA INDONESIA
                                                                    </option>
                                                                    <option value="PENDIDIKAN BAHASA INGGRIS"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN BAHASA INGGRIS' ? 'selected' : '' }}>
                                                                        PENDIDIKAN BAHASA INGGRIS
                                                                    </option>
                                                                    <option value="PENDIDIKAN INFORMATIKA"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN INFORMATIKA' ? 'selected' : '' }}>
                                                                        PENDIDIKAN INFORMATIKA
                                                                    </option>
                                                                    <option
                                                                        value="PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI' ? 'selected' : '' }}>
                                                                        PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI
                                                                    </option>
                                                                    <option value="PENDIDIKAN MATEMATIKA"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN MATEMATIKA' ? 'selected' : '' }}>
                                                                        PENDIDIKAN MATEMATIKA
                                                                    </option>
                                                                    <option value="PENDIDIKAN SEJARAH"
                                                                        {{ $biodata->prodi_perekom == 'PENDIDIKAN SEJARAH' ? 'selected' : '' }}>
                                                                        PENDIDIKAN SEJARAH
                                                                    </option>
                                                                </select>
                                                            @else
                                                                <select name="prodi_perekom" class="form-control">
                                                                    <option value="" disabled selected>Pilih Jurusan
                                                                        / Program Studi</option>
                                                                    <option value="BUKAN MAHASISWA">BUKAN MAHASISWA
                                                                    </option>
                                                                    <option value="PENDIDIKAN GURU SEKOLAH DASAR">
                                                                        PENDIDIKAN GURU SEKOLAH DASAR
                                                                    </option>
                                                                    <option value="PENDIDIKAN BAHASA DAN SASTRA INDONESIA">
                                                                        PENDIDIKAN BAHASA DAN SASTRA INDONESIA
                                                                    </option>
                                                                    <option value="PENDIDIKAN BAHASA INGGRIS">PENDIDIKAN
                                                                        BAHASA INGGRIS
                                                                    </option>
                                                                    <option value="PENDIDIKAN INFORMATIKA">PENDIDIKAN
                                                                        INFORMATIKA
                                                                    </option>
                                                                    <option
                                                                        value="PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI">
                                                                        PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI
                                                                    </option>
                                                                    <option value="PENDIDIKAN MATEMATIKA">PENDIDIKAN
                                                                        MATEMATIKA
                                                                    </option>
                                                                    <option value="PENDIDIKAN SEJARAH">PENDIDIKAN SEJARAH
                                                                    </option>
                                                                </select>
                                                            @endif
                                                            @error('prodi_perekom')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div
                                                            class="form-group @error('nim_perekom') has-error @enderror ">
                                                            <label for="exampleInputPassword1">NIM Perekom (Biarkan Kosong
                                                                Jika Perekom Bukan Mahasiswa) </label>
                                                            <input type="number" class="form-control "
                                                                name="nim_perekom"
                                                                value="{{ old('nim_perekom') ?? $biodata == null ? '' : $biodata->nim_perekom }}"
                                                                placeholder="Masukan NIM Perekom">
                                                            @error('nim_perekom')
                                                                <span class="help-block">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                        <a href="{{ url('mahasiswa/cetak') }}" class="btn btn-success">Verifikasi & Cetak (Klik Disini)</a>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.tab-content -->
                                        </div>
                                        <!-- nav-tabs-custom -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
            @endif
        </div>
        <!-- /.row -->
    </section>
@endsection
