@extends('layouts.mahasiswa')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box container">
                    <h5>Edit Data</h5>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('mahasiswa.update.data') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group @error('jalur') has-error @enderror">
                                <label for="exampleInputEmail1">Jalur Kelas</label>
                                @if (Auth::user()->gelombang_id == 9)
                                    <select required name="jalur" class="form-control" id="jalur">
                                        <option value="" readonly>Pilih Kelas</option>
                                        <option value="REGULAR" {{ $mahasiswa->jalur == 'REGULAR' ? 'selected' : '' }}>KELAS
                                            REGULER</option>
                                    </select>
                                @else
                                    <select required name="jalur" class="form-control" id="jalur">
                                        <option value="" readonly>Pilih Kelas</option>
                                        <option value="REGULAR" {{ $mahasiswa->jalur == 'REGULAR' ? 'selected' : '' }}>KELAS
                                            REGULER</option>
                                        <option value="EKSEKUTIF" {{ $mahasiswa->jalur == 'EKSEKUTIF' ? 'selected' : '' }}>
                                            KELAS EKSEKUTIF</option>
                                    </select>
                                @endif
                                @error('jalur')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('jurusan_id') has-error @enderror">
                                <label for="exampleInputEmail1">Jurusan / Program Studi Pilihan 1</label>
                                <select required name="jurusan_id" class="form-control" id="jurusan_id">
                                    <option value="">Pilih Jurusan / Program Studi</option>
                                    @foreach ($jurusan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $mahasiswa->jurusan_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('jurusan_dua') has-error @enderror ">
                                <label for="exampleInputPassword1">Jurusan / Program Studi Pilihan 2</label>
                                @if ($biodata)
                                    <select name="jurusan_dua" class="form-control">
                                        <option value="" disabled selected>Pilih Jurusan / Program Studi</option>
                                        <option value="PENDIDIKAN GURU SEKOLAH DASAR"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN GURU SEKOLAH DASAR' ? 'selected' : '' }}>
                                            PENDIDIKAN GURU SEKOLAH DASAR
                                        </option>
                                        <option value="PENDIDIKAN BAHASA DAN SASTRA INDONESIA"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN BAHASA DAN SASTRA INDONESIA' ? 'selected' : '' }}>
                                            PENDIDIKAN BAHASA DAN SASTRA INDONESIA
                                        </option>
                                        <option value="PENDIDIKAN BAHASA INGGRIS"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN BAHASA INGGRIS' ? 'selected' : '' }}>
                                            PENDIDIKAN BAHASA INGGRIS
                                        </option>
                                        <option value="PENDIDIKAN INFORMATIKA"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN INFORMATIKA' ? 'selected' : '' }}>
                                            PENDIDIKAN INFORMATIKA
                                        </option>
                                        <option value="PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI' ? 'selected' : '' }}>
                                            PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI
                                        </option>
                                        <option value="PENDIDIKAN MATEMATIKA"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN MATEMATIKA' ? 'selected' : '' }}>
                                            PENDIDIKAN MATEMATIKA
                                        </option>
                                        <option value="PENDIDIKAN SEJARAH"
                                            {{ $biodata->jurusan_dua == 'PENDIDIKAN SEJARAH' ? 'selected' : '' }}>
                                            PENDIDIKAN SEJARAH
                                        </option>
                                    </select>
                                @else
                                    <select name="jurusan_dua" class="form-control">
                                        <option value="" disabled selected>Prodi Pilihan Kedua</option>
                                        <option value="PENDIDIKAN GURU SEKOLAH DASAR">PENDIDIKAN GURU SEKOLAH DASAR
                                        </option>
                                        <option value="PENDIDIKAN BAHASA DAN SASTRA INDONESIA">PENDIDIKAN BAHASA DAN SASTRA
                                            INDONESIA
                                        </option>
                                        <option value="PENDIDIKAN BAHASA INGGRIS">PENDIDIKAN BAHASA INGGRIS
                                        </option>
                                        <option value="PENDIDIKAN INFORMATIKA">PENDIDIKAN INFORMATIKA
                                        </option>
                                        <option value="PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI">PENDIDIKAN JASMANI,
                                            KESEHATAN DAN REKREASI
                                        </option>
                                        <option value="PENDIDIKAN MATEMATIKA">PENDIDIKAN MATEMATIKA
                                        </option>
                                        <option value="PENDIDIKAN SEJARAH">PENDIDIKAN SEJARAH
                                        </option>
                                    </select>
                                @endif
                                @error('jurusan_dua')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group @error('penerimaan_id') has-error @enderror">
                                <label for="exampleInputEmail1">Jalur Penerimaan</label>
                                <select required name="penerimaan_id" class="form-control" id="penerimaan">
                                    <option value="">Pilih Jalur Penerimaan</option>
                                    @foreach ($penerimaan as $item)
                                        @if (Auth::user()->gelombang_id == 8 || Auth::user()->gelombang_id == 14 || Auth::user()->gelombang_id == 15)
                                            @if ($item->id !== 1)
                                                <option value="{{ $item->id }}"
                                                    {{ $mahasiswa->penerimaan_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @elseif (Auth::user()->gelombang_id == 9)
                                            @if ($item->id == 3)
                                                <option value="{{ $item->id }}"
                                                    {{ $mahasiswa->penerimaan_id === $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endif
                                        @else
                                            <option value="{{ $item->id }}"
                                                {{ $mahasiswa->penerimaan_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('penerimaan_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="data" id="Biodata"></div>
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    </div>

                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                    <a href="{{ url('mahasiswa/biodata') }}" class="btn btn-success">
                        Langkah Selanjutnya Isi Biodata (Klik Disini)
                    </a> <br><br>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal{{ $penerimaan[0]->id }}" tabindex="-1" role="dialog"
        aria-labelledby="modalOrderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h5 class="mt-2">{{ $penerimaan[0]->name }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <form action="{{ route('mahasiswa.update.data') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group @error('kartu_keluarga') has-error @enderror  input-id ">
                                            <label for="exampleInputEmail1">Kartu Keluarga</label>
                                            <input type="file" name="kartu_keluarga" accept="application/pdf, image/*"
                                                class="form-control">
                                            <input type="hidden" name="jurusan_id" class="form-control jurusan_id">
                                            <input type="hidden" name="penerimaan_id" class="form-control penerimaan">
                                            @error('kartu_keluarga')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('nisn') has-error @enderror">
                                            <label for="exampleInputEmail1">NISN</label>
                                            <input type="file" accept="application/pdf, image/*" name="nisn"
                                                class="form-control">
                                            @error('nisn')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                                            <label for="exampleInputEmail1">Bukti Pembayaran</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="bukti_pembayaran" class="form-control">
                                            @error('bukti_pembayaran')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('pas_poto') has-error @enderror">
                                            <label for="exampleInputEmail1">Pas Foto 4x6</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="pas_poto" class="form-control">
                                            @error('pas_poto')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('rapor') has-error @enderror">
                                            <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="rapor" class="form-control">
                                            @error('rapor')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('kip') has-error @enderror">
                                            <label for="exampleInputEmail1">KIP/KKS/PKH/SURAT PANTI ASUHAN/ SURAT
                                                PENGHASILAN ORTU</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="kip" class="form-control">
                                            @error('kip')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('prestasi') has-error @enderror">
                                            <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="prestasi" class="form-control">
                                            @error('prestasi')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('sktm') has-error @enderror">
                                            <label for="exampleInputEmail1">SKTM</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="sktm" class="form-control">
                                            @error('sktm')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('ktp_ortu') has-error @enderror">
                                            <label for="exampleInputEmail1">KTP Orang Tua & Pendaftar</label>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="ktp_ortu" class="form-control">
                                            @error('ktp_ortu')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group @error('pdu') has-error @enderror">
                                            <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika
                                                Ada)</label>
                                            <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP
                                            </p>
                                            <input type="file" id="input-id" accept="application/pdf, image/*"
                                                name="pdu" class="form-control">
                                            @error('pdu')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <p><strong>Note : <strong><i>File upload harus berformat
                                                    <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB
                                                        (Total Semua Berkas)</strong></i></p>
                                </div>
                                <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#jalur').trigger('change');
            $('#jalur').change(function() {
                let data = $(this).val();
                let select = document.getElementById("penerimaan");
                for (var i = 0; i < select.length; i++) {
                    if (data == 'EKSEKUTIF') {
                        if (select.options[i].value == 7) {
                            $(select.options[i]).attr('disabled', 'disabled').hide();
                        }
                    } else {
                        if (select.options[i].value == 7) {
                            $(select.options[i]).removeAttr('disabled').show();
                        }
                    }
                }
            });

            //Jika Ada Data
            let penerimaan_id = $("#penerimaan").val();
            if (penerimaan_id) {
                if (penerimaan_id == 1) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror  input-id ">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" name="kartu_keluarga"  accept="application/pdf, image/*" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror  input-id ">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" accept="application/pdf, image/*"  name="nisn" class="form-control">
                    @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                     @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                     @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="rapor" class="form-control">
                     @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->kip != null ? 'has-success' : '' }} @error('kip') has-error @enderror">
                    <label for="exampleInputEmail1">KIP/KKS/PKH/SURAT PANTI ASUHAN/ SURAT PENGHASILAN ORTU</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="kip" class="form-control">
                     @if ($attachment->kip)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kip')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="prestasi" class="form-control">
                     @if ($attachment->prestasi)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->sktm != null ? 'has-success' : '' }} @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM (Optional)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="sktm" class="form-control">
                     @if ($attachment->sktm)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->ktp_ortu != null ? 'has-success' : '' }} @error('ktp_ortu') has-error @enderror">
                    <label for="exampleInputEmail1">KTP Orang Tua (Ayah dan Ibu) & Pendaftar</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="ktp_ortu" class="form-control">
                     @if ($attachment->ktp_ortu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ktp_ortu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
    `);
                }
                if (penerimaan_id == 2) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file"  name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file"  name="nisn" class="form-control">
                     @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file"  name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file"  name="ijazah" class="form-control">
                     @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file"  name="pas_poto" class="form-control">
                     @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file"  name="rapor" class="form-control">
                     @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                     @if ($attachment->prestasi)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (penerimaan_id == 12) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file"  name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file"  name="nisn" class="form-control">
                     @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <!--<div class="col-lg-12">
                  <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file"  name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>-->
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file"  name="ijazah" class="form-control">
                     @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file"  name="pas_poto" class="form-control">
                     @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Surat Undangan</label>
                    <input type="file"  name="rapor" class="form-control">
                     @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                     @if ($attachment->prestasi)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (penerimaan_id == 11) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file"  name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file"  name="nisn" class="form-control">
                     @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file"  name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file"  name="ijazah" class="form-control">
                     @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file"  name="pas_poto" class="form-control">
                     @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file"  name="rapor" class="form-control">
                     @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                     @if ($attachment->prestasi)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (penerimaan_id == 3) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
              <div class="col-lg-4">
                <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                  <label for="exampleInputEmail1">Kartu Keluarga</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*"  name="kartu_keluarga" class="form-control">
                   @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('kartu_keluarga')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                  <label for="exampleInputEmail1">NISN / KTP</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="nisn" class="form-control">
                   @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('nisn')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                  <label for="exampleInputEmail1">Bukti Pembayaran</label>
                  <input type="file"  name="bukti_pembayaran" class="form-control">
                   @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('bukti_pembayaran')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                  <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="ijazah" class="form-control">
                   @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('ijazah')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                  <label for="exampleInputEmail1">Pas Foto 4x6</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                   @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('pas_poto')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
              <!--<div class="col-lg-4">
                <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                  <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*"  name="rapor" class="form-control">
                   @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('rapor')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>-->
            </div>
            <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
    `);
                }
                if (penerimaan_id == 4) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                  <label for="exampleInputEmail1">Kartu Keluarga</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                   @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('kartu_keluarga')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                  <label for="exampleInputEmail1">NISN</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*"  name="nisn" class="form-control">
                   @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('nisn')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                  <label for="exampleInputEmail1">Bukti Pembayaran</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                   @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('bukti_pembayaran')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                  <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="ijazah" class="form-control"> @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('ijazah')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                  <label for="exampleInputEmail1">Pas Foto 4x6</label>
                  <input type="file"  name="pas_poto" class="form-control">
                   @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('pas_poto')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                  <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="rapor" class="form-control">
                   @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                  @error('rapor')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
            </div>`);
                }
                if (penerimaan_id == 5) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file"  name="nisn" class="form-control">
                    @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->rapor != null ? 'has-success' : '' }} @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="rapor" class="form-control">
                    @if ($attachment->rapor)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->sktm != null ? 'has-success' : '' }} @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="sktm" class="form-control">
                    @if ($attachment->sktm)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="prestasi" class="form-control">
                    @if ($attachment->prestasi)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>
    `);
                }
                if (penerimaan_id == 6) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="nisn" class="form-control">
                    @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group{{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_poto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file"  name="pas_poto" class="form-control">
                    @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="ijazah" class="form-control">
                    @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->skot != null ? 'has-success' : '' }} @error('skot') has-error @enderror">
                    <label for="exampleInputEmail1">Surat Keterangan dari Desa atau Akta Kematian Ortu</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="skot" class="form-control">
                    @if ($attachment->skot)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('skot')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>
              `);
                }
                if (penerimaan_id == 7) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->kartu_keluarga != null ? 'has-success' : '' }} @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                    @if ($attachment->kartu_keluarga)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->nisn != null ? 'has-success' : '' }} @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="nisn" class="form-control">
                    @if ($attachment->nisn)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="bukti_pembayaran" class="form-control">
                    @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->pas_foto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @if ($attachment->pas_poto)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*"  name="ijazah" class="form-control">
                    @if ($attachment->ijazah)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <!--<div class="col-lg-12">
                  <div class="form-group {{ $attachment->sktm != null ? 'has-success' : '' }} @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="sktm" class="form-control">
                    @if ($attachment->sktm)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>-->
                <div class="col-lg-12">
                  <div class="form-group {{ $attachment->hafidz != null ? 'has-success' : '' }} @error('hafidz') has-error @enderror">
                    <label for="exampleInputEmail1">Surat keterangan Hafizh Qur'an</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="hafidz" class="form-control">
                    @if ($attachment->hafidz)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('hafidz')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>
    `);
                }

                if (penerimaan_id == 8) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`<div class="row">
                <div class="col-lg-12">
                  <div class="form-group  {{ $attachment->bukti_pembayaran != null ? 'has-success' : '' }} @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                     @if ($attachment->bukti_pembayaran)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                          <div class="col-lg-12">
                  			<div class="form-group {{ $attachment->ijazah != null ? 'has-success' : '' }} @error('ijazah') has-error @enderror">
                    			<label for="exampleInputEmail1">Ijazah dan Transkrip Nilai</label>
                    			<input type="file" id="input-id" accept="application/pdf, image/*" name="ijazah" class="form-control">
                    			@if ($attachment->ijazah)
                    			<span class="help-block"><i class="fa fa-check"></i> File</span>
                    			@endif
                    			@error('ijazah')
                    			<span class="help-block">{{ $message }}</span>
                  				@enderror
                  			</div>
                		  </div>
                		  <div class="col-lg-12">
                  			<div class="form-group {{ $attachment->pas_foto != null ? 'has-success' : '' }} @error('pas_poto') has-error @enderror">
                    			<label for="exampleInputEmail1">Pas Foto 4x6</label>
                    			<input type="file" id="input-id" accept="application/pdf, image/*"  name="pas_poto" class="form-control">
                    			@if ($attachment->pas_poto)
                    			<span class="help-block"><i class="fa fa-check"></i> File</span>
                    			@endif
                    			@error('pas_poto')
                    			<span class="help-block">{{ $message }}</span>
                  				@enderror
                  			</div>
                		 </div>
                        <div class="col-lg-12">
                  			<div class="form-group  {{ $attachment->ktp_ortu != null ? 'has-success' : '' }} @error('ktp_ortu') has-error @enderror">
                    			<label for="exampleInputEmail1">KTP</label>
                    			<input type="file" id="input-id" accept="application/pdf, image/*" name="ktp_ortu" class="form-control">
                     			@if ($attachment->ktp_ortu)
                    			<span class="help-block"><i class="fa fa-check"></i> File</span>
                    			@endif
                    			@error('ktp_ortu')
                    			<span class="help-block">{{ $message }}</span>
                  				@enderror
                  			</div>
                		</div>
                		<div class="col-lg-12">
                  			<div class="form-group {{ $attachment->prestasi != null ? 'has-success' : '' }} @error('prestasi') has-error @enderror">
                    			<label for="exampleInputEmail1">Akta Mengajar atau Surat Keterangan Bekerja  (Jika Ada)</label>
                    			<input type="file" accept="application/pdf, image/*" name="prestasi" class="form-control">
                   			 	@if ($attachment->prestasi)
                    			<span class="help-block"><i class="fa fa-check"></i> File</span>
                    			@endif
                    			@error('prestasi')
                    			<span class="help-block">{{ $message }}</span>
                  				@enderror
                  			</div>
                		</div>
                		<div class="col-lg-12">
                <div class="form-group {{ $attachment->pdu != null ? 'has-success' : '' }} @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu"  class="form-control">
                    @if ($attachment->pdu)
                    <span class="help-block"><i class="fa fa-check"></i> File</span>
                    @endif
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              		</div>`);
                }

            }
            // Tutup

            $("#penerimaan").change(function() {
                var id = $(this).val();;
                var dataString = 'id=' + id;
                let jurusan_id = $("#jurusan_id").val();
                let penerimaan_id = $("#penerimaan").val();

                $(".penerimaan").val(penerimaan_id);
                $(".jurusan_id").val(jurusan_id);

                if (id == 1) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" id="input-id"  accept="application/pdf, image/*" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="rapor" class="form-control">
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('kip') has-error @enderror">
                    <label for="exampleInputEmail1">KIP/KKS/PKH/SURAT PANTI ASUHAN/ SURAT PENGHASILAN ORTU</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kip" class="form-control">
                    @error('kip')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="prestasi" class="form-control">
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM (Optional)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="sktm" class="form-control">
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('ktp_ortu') has-error @enderror">
                    <label for="exampleInputEmail1">KTP Orang Tua (Ayah dan Ibu) & Pendaftar</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="ktp_ortu" class="form-control">
                    @error('ktp_ortu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>

                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
    `);
                }
                if (id == 2) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" required name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" required name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" required name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file" required name="ijazah" class="form-control">
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" required name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file" required name="rapor" class="form-control">
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (id == 12) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" required name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" required name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <!--<div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" required name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>-->
                <div class="col-lg-12">
                  <div class="form-group @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file" required name="ijazah" class="form-control">
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" required name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Surat Undangan</label>
                    <input type="file" required name="rapor" class="form-control">
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (id == 11) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
    <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" required name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" required name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" required name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('ijazah') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file" required name="ijazah" class="form-control">
                    @error('ijazah')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" required name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file" required name="rapor" class="form-control">
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" name="prestasi" class="form-control">
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                </div>
    `)
                }
                if (id == 3) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
              <div class="col-lg-4">
                <div class="form-group @error('kartu_keluarga') has-error @enderror">
                  <label for="exampleInputEmail1">Kartu Keluarga</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                  @error('kartu_keluarga')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group @error('nisn') has-error @enderror">
                  <label for="exampleInputEmail1">NISN</label>
                  <input type="file"  name="nisn" class="form-control">
                  @error('nisn')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                  <label for="exampleInputEmail1">Bukti Pembayaran</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                  @error('bukti_pembayaran')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group @error('ijazah') has-error @enderror">
                  <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                  <input type="file"  name="ijazah" class="form-control">
                  @error('ijazah')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group @error('pas_poto') has-error @enderror">
                  <label for="exampleInputEmail1">Pas Foto 4x6</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                  @error('pas_poto')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
              <!--<div class="col-lg-4">
                <div class="form-group @error('rapor') has-error @enderror">
                  <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="rapor" class="form-control">
                  @error('rapor')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>-->
            </div>
            <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
    `);
                }
                if (id == 4) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
              <div class="col-lg-12">
                <div class="form-group @error('kartu_keluarga') has-error @enderror">
                  <label for="exampleInputEmail1">Kartu Keluarga</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                  @error('kartu_keluarga')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group @error('nisn') has-error @enderror">
                  <label for="exampleInputEmail1">NISN</label>
                  <input type="file"  name="nisn" class="form-control">
                  @error('nisn')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                  <label for="exampleInputEmail1">Bukti Pembayaran</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                  @error('bukti_pembayaran')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                  <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="ijazah" class="form-control">
                  @error('bukti_pembayaran')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group @error('pas_poto') has-error @enderror">
                  <label for="exampleInputEmail1">Pas Foto 4x6</label>
                  <input type="file"  name="pas_poto" class="form-control">
                  @error('pas_poto')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group @error('rapor') has-error @enderror">
                  <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                  <input type="file" id="input-id" accept="application/pdf, image/*" name="rapor" class="form-control">
                  @error('rapor')
                  <span class="help-block">{{ $message }}</span>
                @enderror
                </div>
              </div>
              <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
            </div>`);
                }
                if (id == 5) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
                <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file"  name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('rapor') has-error @enderror">
                    <label for="exampleInputEmail1">Rapor SMT 1-5</label>
                    <input type="file"  name="rapor" class="form-control">
                    @error('rapor')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="sktm" class="form-control">
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('prestasi') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="prestasi" class="form-control">
                    @error('prestasi')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>
    `);
                }
                if (id == 6) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
                <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file"  name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file"  name="ijazah" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('skot') has-error @enderror">
                    <label for="exampleInputEmail1">Surat Keterangan dari Desa atau Akta Kematian Ortu</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="skot" class="form-control">
                    @error('skot')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>`);
                }
                if (id == 7) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
    <div class="row">
                <div class="col-lg-12">
                  <div class="form-group @error('kartu_keluarga') has-error @enderror">
                    <label for="exampleInputEmail1">Kartu Keluarga</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="kartu_keluarga" class="form-control">
                    @error('kartu_keluarga')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('nisn') has-error @enderror">
                    <label for="exampleInputEmail1">NISN</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="nisn" class="form-control">
                    @error('nisn')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file"  name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pas_poto') has-error @enderror">
                    <label for="exampleInputEmail1">Pas Foto 4x6</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                    @error('pas_poto')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                    <input type="file"  name="ijazah" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <!--<div class="col-lg-12">
                  <div class="form-group @error('sktm') has-error @enderror">
                    <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="sktm" class="form-control">
                    @error('sktm')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>-->
                <div class="col-lg-12">
                  <div class="form-group @error('hafidz') has-error @enderror">
                    <label for="exampleInputEmail1">Surat keterangan Hafizh Qur'an</label>
                    <input type="file"  name="hafidz" class="form-control">
                    @error('hafidz')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
              </div>
    `);
                }

                if (id == 8) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
                <div class="row">
                <div class="col-lg-12">
                  <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                    <label for="exampleInputEmail1">Bukti Pembayaran</label>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                          <div class="col-lg-12">
                            <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                              <label for="exampleInputEmail1">Ijazah dan Transkrip Nilai</label>
                              <input type="file" id="input-id" accept="application/pdf, image/*" name="ijazah" class="form-control">
                              @error('bukti_pembayaran')
                              <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group @error('pas_poto') has-error @enderror">
                              <label for="exampleInputEmail1">Pas Foto 4x6</label>
                              <input type="file" id="input-id" accept="application/pdf, image/*" name="pas_poto" class="form-control">
                              @error('pas_poto')
                              <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
                          <div class="col-lg-12">
                          	<div class="form-group @error('ktp_ortu') has-error @enderror">
                             <label for="exampleInputEmail1">KTP</label>
                             <input type="file"  name="ktp_ortu" class="form-control">
                             @error('ktp_ortu')
                             <span class="help-block">{{ $message }}</span>
                           @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                              <div class="form-group @error('prestasi') has-error @enderror">
                                <label for="exampleInputEmail1">Akta Mengajar atau Surat Keterangan Bekerja  (Jika Ada)</label>
                                <input type="file" id="input-id" accept="application/pdf, image/*" name="prestasi" class="form-control">
                                @error('prestasi')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                           </div>
                           <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file" id="input-id" accept="application/pdf, image/*" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                        </div>
                `);
                }
            });

        });
    </script>

    <!--<script type="text/javascript">
        $(function() {
            $(".input-id").on('change', function(event) {
                var file = event.target.files[0];

                if (!file.type.match('image/*')) {
                    alert("only images & PDF");
                    $("#Biodata").get(0)
                        .reset(); //the tricky part is to "empty" the input file here I reset the form.
                    return;
                }

                if (!file.type.match('application/pdf')) {
                    alert("Only Images & PDF");
                    $("#Biodata").get(0)
                        .reset(); //the tricky part is to "empty" the input file here I reset the form.
                    return;
                }

            });
        });
    </script> -->
@endpush
