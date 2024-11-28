@extends('layouts.mahasiswa')
@section('content')
    <section class="content">
        @if ($mhs->status == 'TES / CBT' || $mhs->status == 'INTERVIEW' || $mhs->status == 'KELUAR')
            <div class="bd">
                <article>
                    <h1 style="text-align: center;">SELAMAT</h1>
                    <div>
                        <h1 style="text-align: center;">DATA PENDAFTARAN ANDA TELAH DIVALIDASI OLEH PANITIA PMB DAN SILAHKAN
                            MENUNGGU INFORMASI UNTUK TAHAPAN TES SELEKSI SELANJUTNYA.</h1>
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
                            @if ($attachment)
                                <div class="row">
                                    <div class="text-center">
                                        <h2>Data Berhasil Di Simpan</h2>
                                        <hr><i><strong>Silahkan Upload Berkas Anda Dengan Lengkap dan Lakukan Tahap
                                                Selanjutnya !</strong></i>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Kelas</td>
                                                <td>:</td>
                                                <td>{{ $mahasiswa->jalur ?? ' ' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Prodi Pilihan 1</td>
                                                <td>:</td>
                                                <td>{{ $mahasiswa->jurusan->name ?? ' ' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Prodi Pilihan 2</td>
                                                <td>:</td>
                                                <td>{{ $biodata->jurusan_dua ?? ' ' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jalur Penerimaan</td>
                                                <td>:</td>
                                                <td>{{ $attachment->penerimaan->name ?? ' ' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12 mr-auto">
                                        <a href="{{ route('edit-attachment', $attachment->id) }}" class="btn btn-primary">
                                            Upload Berkas
                                        </a>
                                        <a href="{{ url('mahasiswa/biodata') }}" class="btn btn-success">
                                            Langkah Selanjutnya Isi Biodata (Klik Disini)
                                        </a>
                                    </div>
                                </div>
                            @else
                                <hr>
                                <i>
                                    <strong>
                                        Silahkan Upload Berkas Anda Dengan Lengkap dan Lakukan Tahap Selanjutnya !
                                    </strong>
                                </i>
                                <form action="{{ route('mahasiswa.update.data') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group @error('jalur') has-error @enderror">
                                        <label for="exampleInputEmail1">Kelas</label>
                                        @if (Auth::user()->gelombang_id == 9)
                                            <select required name="jalur" class="form-control" id="jalur">
                                                <option value="" readonly>Pilih Kelas</option>
                                                <option value="REGULAR">KELAS REGULER</option>
                                                <!--<option value="TRANSFER">KELAS TRANSFER</option>-->
                                                <!--<option value="EKSEKUTIF">KELAS EKSEKUTIF</option>-->
                                            </select>
                                        @else
                                            <select required name="jalur" class="form-control" id="jalur">
                                                <option value="" readonly>Pilih Kelas</option>
                                                <option value="REGULAR">KELAS REGULER</option>
                                                <!--<option value="TRANSFER">KELAS TRANSFER</option>-->
                                                <option value="EKSEKUTIF">KELAS EKSEKUTIF</option>
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
                                                    {{ $mahasiswa->jurusan_id === $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
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
                                                <option value="" disabled selected>Pilih Jurusan / Program Studi
                                                </option>
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
                                                <option value="PENDIDIKAN GURU SEKOLAH DASAR">
                                                    PENDIDIKAN GURU SEKOLAH DASAR
                                                </option>
                                                <option value="PENDIDIKAN BAHASA DAN SASTRA INDONESIA">
                                                    PENDIDIKAN BAHASA DAN SASTRA INDONESIA
                                                </option>
                                                <option value="PENDIDIKAN BAHASA INGGRIS">
                                                    PENDIDIKAN BAHASA INGGRIS
                                                </option>
                                                <option value="PENDIDIKAN INFORMATIKA">
                                                    PENDIDIKAN INFORMATIKA
                                                </option>
                                                <option value="PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI">
                                                    PENDIDIKAN JASMANI, KESEHATAN DAN REKREASI
                                                </option>
                                                <option value="PENDIDIKAN MATEMATIKA">
                                                    PENDIDIKAN MATEMATIKA
                                                </option>
                                                <option value="PENDIDIKAN SEJARAH">
                                                    PENDIDIKAN SEJARAH
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
                                                            {{ $mahasiswa->penerimaan_id === $item->id ? 'selected' : '' }}>
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
                                                        {{ $mahasiswa->penerimaan_id === $item->id ? 'selected' : '' }}>
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

                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                                    <br><br>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        @endif
    </section>

@endsection

@push('addon-script')
    <script type="text/javascript">
        $(document).ready(function() {

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
            })

            $("#penerimaan").change(function() {
                var id = $(this).val();
                console.log(id);
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
                            <input type="file" id="input-id" name="kartu_keluarga" required class="form-control">
                            @error('kartu_keluarga')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('nisn') has-error @enderror">
                            <label for="exampleInputEmail1">NISN</label>
                            <input type="file" id="input-id" required name="nisn" class="form-control">
                            @error('nisn')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                            <label for="exampleInputEmail1">Bukti Pembayaran</label>
                            <input type="file" id="input-id" required name="bukti_pembayaran" class="form-control">
                            @error('bukti_pembayaran')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('pas_poto') has-error @enderror">
                            <label for="exampleInputEmail1">Pas Foto 4x6</label>
                            <input type="file" id="input-id" required name="pas_poto" class="form-control">
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
                          <div class="form-group @error('kip') has-error @enderror">
                            <label for="exampleInputEmail1">KIP/KKS/PKH/SURAT PANTI ASUHAN/ SURAT PENGHASILAN ORTU</label>
                            <input type="file" id= id="input-id"  "input-id" required name="kip" class="form-control">
                            @error('kip')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('prestasi') has-error @enderror">
                            <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                            <input type="file" id="input-id"  name="prestasi" class="form-control">
                            @error('prestasi')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('sktm') has-error @enderror">
                            <label for="exampleInputEmail1">SKTM (Optional)</label>
                            <input type="file"  id="input-id" name="sktm" class="form-control">
                            @error('sktm')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group @error('ktp_ortu') has-error @enderror">
                            <label for="exampleInputEmail1">KTP Orang Tua (Ayah dan Ibu) & Pendaftar</label>
                            <input type="file" required name="ktp_ortu" class="form-control">
                            @error('ktp_ortu')
                            <span class="help-block">{{ $message }}</span>
                          @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
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
                            <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                              <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                              <input type="file" required name="ijazah" class="form-control">
                              @error('bukti_pembayaran')
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
                `);
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
                `);
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
                `);
                }
                if (id == 3) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group @error('kartu_keluarga') has-error @enderror">
                        <label for="exampleInputEmail1">Kartu Keluarga</label>
                        <input type="file" id="input-id" required name="kartu_keluarga" class="form-control">
                        @error('kartu_keluarga')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group @error('nisn') has-error @enderror">
                        <label for="exampleInputEmail1">NISN / KTP</label>
                        <input type="file" required name="nisn" class="form-control">
                        @error('nisn')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Bukti Pembayaran</label>
                        <input type="file" id="input-id"  required name="bukti_pembayaran" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                        <input type="file" required name="ijazah" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group @error('pas_poto') has-error @enderror">
                        <label for="exampleInputEmail1">Pas Foto 4x6</label>
                        <input type="file" id="input-id"  required name="pas_poto" class="form-control">
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
                        <input type="file" id="input-id" accept="application/pdf, image/*"  required name="rapor" class="form-control">
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
                                <input type="file" id="input-id" required name="kartu_keluarga" class="form-control">
                                @error('kartu_keluarga')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('nisn') has-error @enderror">
                                <label for="exampleInputEmail1">NISN</label>
                                <input type="file" id="input-id" required name="nisn" class="form-control">
                                @error('nisn')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                                <label for="exampleInputEmail1">Bukti Pembayaran</label>
                                <input type="file" id="input-id" required name="bukti_pembayaran" class="form-control">
                                @error('bukti_pembayaran')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                                <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                                <input type="file" id="input-id" required name="ijazah" class="form-control">
                                @error('bukti_pembayaran')
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
                                <input type="file" id="input-id" required name="rapor" class="form-control">
                                @error('rapor')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  id="input-id" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
                          </div>`);
                }
                if (id == 5) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
                  <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group @error('kartu_keluarga') has-error @enderror">
                                <label for="exampleInputEmail1">Kartu Keluarga</label>
                                <input type="file" id="input-id" required name="kartu_keluarga" class="form-control">
                                @error('kartu_keluarga')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('nisn') has-error @enderror">
                                <label for="exampleInputEmail1">NISN</label>
                                <input type="file" id="input-id" required name="nisn" class="form-control">
                                @error('nisn')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                                <label for="exampleInputEmail1">Bukti Pembayaran</label>
                                <input type="file" id="input-id" required name="bukti_pembayaran" class="form-control">
                                @error('bukti_pembayaran')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('pas_poto') has-error @enderror">
                                <label for="exampleInputEmail1">Pas Foto 4x6</label>
                                <input type="file" id="input-id" required name="pas_poto" class="form-control">
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
                              <div class="form-group @error('sktm') has-error @enderror">
                                <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                                <input type="file" id="input-id" required name="sktm" class="form-control">
                                @error('sktm')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group @error('prestasi') has-error @enderror">
                                <label for="exampleInputEmail1">Bukti Prestasi (Jika Ada)</label>
                                <input type="file" required name="prestasi" class="form-control">
                                @error('prestasi')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                            </div>
                            <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  id="input-id" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
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
                        <input type="file" id="input-id"  required name="kartu_keluarga" class="form-control">
                        @error('kartu_keluarga')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('nisn') has-error @enderror">
                        <label for="exampleInputEmail1">NISN</label>
                        <input type="file" id="input-id" required name="nisn" class="form-control">
                        @error('nisn')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Bukti Pembayaran</label>
                        <input type="file" id="input-id"  required name="bukti_pembayaran" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('pas_poto') has-error @enderror">
                        <label for="exampleInputEmail1">Pas Foto 4x6</label>
                        <input type="file" id="input-id" required name="pas_poto" class="form-control">
                        @error('pas_poto')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                        <input type="file" id="input-id"  required name="ijazah" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('skot') has-error @enderror">
                        <label for="exampleInputEmail1">Surat Keterangan dari Desa atau Akta Kematian Ortu</label>
                        <input type="file" id="input-id" required name="skot" class="form-control">
                        @error('skot')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  id="input-id" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
                  </div>
                `);
                }
                if (id == 7) {
                    $('#Biodata').empty();
                    $('#Biodata').append(`
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group @error('kartu_keluarga') has-error @enderror">
                        <label for="exampleInputEmail1">Kartu Keluarga</label>
                        <input type="file" id="input-id" accept="application/pdf, image/*"  required name="kartu_keluarga" class="form-control">
                        @error('kartu_keluarga')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('nisn') has-error @enderror">
                        <label for="exampleInputEmail1">NISN</label>
                        <input type="file" id="input-id"  required name="nisn" class="form-control">
                        @error('nisn')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Bukti Pembayaran</label>
                        <input type="file" id="input-id"  required name="bukti_pembayaran" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('pas_poto') has-error @enderror">
                        <label for="exampleInputEmail1">Pas Foto 4x6</label>
                        <input type="file" id="input-id" required name="pas_poto" class="form-control">
                        @error('pas_poto')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                        <label for="exampleInputEmail1">Ijazah/Transkrip/SKL</label>
                        <input type="file" id="input-id"  required name="ijazah" class="form-control">
                        @error('bukti_pembayaran')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <!--<div class="col-lg-12">
                      <div class="form-group @error('sktm') has-error @enderror">
                        <label for="exampleInputEmail1">SKTM / Surat Keterangan Penghasilan Orang Tua</label>
                        <input type="file" id="input-id" accept="application/pdf, image/*"  required name="sktm" class="form-control">
                        @error('sktm')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>-->
                    <div class="col-lg-12">
                      <div class="form-group @error('hafidz') has-error @enderror">
                        <label for="exampleInputEmail1">Surat keterangan Hafizh Qur'an</label>
                        <input type="file" id="input-id" required name="hafidz" class="form-control">
                        @error('hafidz')
                        <span class="help-block">{{ $message }}</span>
                      @enderror
                      </div>
                    </div>
                    <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  id="input-id" name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
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
                    <input type="file" id="input-id" required name="bukti_pembayaran" class="form-control">
                    @error('bukti_pembayaran')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                </div>
                          <div class="col-lg-12">
                            <div class="form-group @error('bukti_pembayaran') has-error @enderror">
                              <label for="exampleInputEmail1">Ijazah dan Transkrip Nilai</label>
                              <input type="file" id="input-id"  required name="ijazah" class="form-control">
                              @error('bukti_pembayaran')
                              <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group @error('pas_poto') has-error @enderror">
                              <label for="exampleInputEmail1">Pas Foto 4x6</label>
                              <input type="file" id="input-id" required name="pas_poto" class="form-control">
                              @error('pas_poto')
                              <span class="help-block">{{ $message }}</span>
                            @enderror
                            </div>
                          </div>
                          <div class="col-lg-12">
                          	<div class="form-group @error('ktp_ortu') has-error @enderror">
                             <label for="exampleInputEmail1">KTP</label>
                             <input type="file" id="input-id" required name="ktp_ortu" class="form-control">
                             @error('ktp_ortu')
                             <span class="help-block">{{ $message }}</span>
                           @enderror
                          </div>
                        </div>
                        <div class="col-lg-12">
                              <div class="form-group @error('prestasi') has-error @enderror">
                                <label for="exampleInputEmail1">Akta Mengajar atau Surat Keterangan Bekerja  (Jika Ada)</label>
                                <input type="file" id="input-id" name="prestasi" class="form-control">
                                @error('prestasi')
                                <span class="help-block">{{ $message }}</span>
                              @enderror
                              </div>
                           </div>
                           <div class="col-lg-12">
                  <div class="form-group @error('pdu') has-error @enderror">
                    <label for="exampleInputEmail1">KERINGANAN/POTONGAN DAFTAR ULANG (Jika Ada)</label>
                    <p>Kartu PGRI ortu / ortu alumni STKIP/ KTM saudara yang kuliah aktif di STKIP</p>
                    <input type="file"  id="input-id"  name="pdu" class="form-control">
                    @error('pdu')
                    <span class="help-block">{{ $message }}</span>
                  @enderror
                  </div>
                  <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                </div>
                        </div>
                `);
                }
            });

        });
    </script>
@endpush
