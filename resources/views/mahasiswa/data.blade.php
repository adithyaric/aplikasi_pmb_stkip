@extends('layouts.mahasiswa')
@section('content')
    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($mhs->status == 'TES / CBT' || $mhs->status == 'INTERVIEW' || $mhs->status == 'KELUAR')
            <div class="bd">
                <article>
                    <h1 style="text-align: center;">SELAMAT</h1>
                    <div>
                        <h1 style="text-align: center;">
                            DATA PENDAFTARAN ANDA TELAH DIVALIDASI OLEH PANITIA PMB DAN SILAHKAN MENUNGGU INFORMASI UNTUK TAHAPAN TES SELEKSI SELANJUTNYA.
                        </h1>
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
                                        <hr>
                                        <i>
                                            <strong>
                                                Silahkan Upload Berkas Anda Dengan Lengkap dan Lakukan TahapSelanjutnya !
                                            </strong>
                                        </i>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Kelas</td>
                                                <td>:</td>
                                                <td>{{ $mahasiswa?->jalur }}</td>
                                            </tr>
                                            <tr>
                                                <td>Prodi Pilihan 1</td>
                                                <td>:</td>
                                                <td>{{ $mahasiswa?->jurusan?->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Prodi Pilihan 2</td>
                                                <td>:</td>
                                                <td>{{ $biodata?->jurusan_dua }}</td>
                                            </tr>
                                            <tr>
                                                <td>Jalur Penerimaan</td>
                                                <td>:</td>
                                                <td>{{ $attachment?->penerimaan?->name }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12 mr-auto">
                                        <a href="{{ route('edit-attachment', ['id' => $attachment->id]) }}" class="btn btn-primary">
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
                                        <label for="jalur">Kelas</label>
                                        <select required name="jalur" class="form-control" id="jalur">
                                            <option value="" readonly>Pilih Kelas</option>
                                            @foreach($kelas as $k)
                                            <option value="{{ $k->name }}" {{ $mahasiswa->jalur == $k->name ? 'selected' : '' }}>
                                                {{ strtoupper($k->name) }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('jalur')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('jurusan_id') has-error @enderror">
                                        <label for="jurusan_id">Jurusan / Program Studi Pilihan 1</label>
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
                                        <label for="jurusan_dua">Jurusan / Program Studi Pilihan 2</label>
                                        <select required name="jurusan_dua" class="form-control" id="jurusan_dua">
                                            <option value="">Pilih Jurusan / Program Studi</option>
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item->name }}"
                                                    {{ isset($biodata) && $biodata?->jurusan_dua === $item->name ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jurusan_dua')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('penerimaan_id') has-error @enderror">
                                        <label for="penerimaan_id">Jalur Penerimaan</label>
                                        <select required name="penerimaan_id" class="form-control" id="penerimaan">
                                            <option value="">Pilih Jalur Penerimaan</option>
                                            @foreach ($penerimaan as $item)
                                                <option value="{{ $item->id }}" {{ $mahasiswa->penerimaan_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('penerimaan_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="Biodata">
                                        @foreach ($persyaratan as $syarat)
                                            @php
                                                $attachmentField = $syarat->slug; // Dynamic field name from persyaratan
                                                $attachmentValue = $attachment->$attachmentField; // Get the corresponding value from the attachment
                                            @endphp

                                            <div class="col-lg-12 persyaratan-item" data-penerimaan="{{ $syarat->penerimaan->pluck('id')->join(',') }}">
                                                <div class="form-group">
                                            @if ($syarat->is_required)
                                                <span style="color: red;"> *wajib diisi</span>
                                            @endif
                                                    <label>{{ strtoupper(str_replace('_', ' ', $syarat->name)) }}</label>

                                                    @if ($syarat->input_type === 'file' && $attachmentValue)
                                                        <div>
                                                            <a href="{{ asset('storage/' . $attachmentValue) }}" target="_blank">
@php
    $extension = pathinfo($attachmentValue, PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
@endphp

@if (in_array(strtolower($extension), $allowedExtensions))
    <img src="{{ asset('storage/' . $attachmentValue) }}" alt="{{ $syarat->slug }}" class="img-thumbnail" style="max-width: 150px;">
@else
    <p>Preview</p>
@endif
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <input type="{{ $syarat->input_type }}"
                                                        accept=".pdf,image/*"
                                                        name="{{ $syarat->slug }}"
                                                        class="form-control"
                                                        {{ $syarat->input_type === 'file' ? '' : 'value=' . old($syarat->slug, $attachmentValue) }}
                                                        {{ $syarat->is_required ? 'required' : '' }}>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">

                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
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
            //#jalur = select kelas #TODO hardcoded
            $('#jalur').on('change', function() {
                $('#Biodata').empty();
                let selectedKelas = $(this).val();
                let penerimaanSelect = $('#penerimaan');

                // Reset the dropdown
                penerimaanSelect.val('').trigger('change');

                // Disable or enable the specific option based on Kelas selection
                penerimaanSelect.find('option[value="7"]').each(function() {
                    if (selectedKelas === 'EKSEKUTIF') {
                        $(this).attr('disabled', true).hide();
                    } else {
                        $(this).removeAttr('disabled').show();
                    }
                });
            });

            //#penerimaan = select jalur penerimaan
            $("#penerimaan").change(function() {
                var id = $(this).val();
                $.ajax({
                    url: '/get-persyaratan',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        $('#Biodata').empty();
                        response.persyaratan.forEach(function(item) {
                            var isRequired = item.is_required == 1 ? true : false; // Ensure boolean check
                            console.log(item.is_required);
                            console.log(isRequired);
                            $('#Biodata').append(`
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        ${isRequired ? '<span style="color: red;"> *wajib diisi</span>' : ''}
                                        <label>${item.name}</label>
                                        <input type="file" name="${item.slug}" class="form-control" ${isRequired ? "required" : ""}>
                                    </div>
                                </div>
                            `);
                        });
                    }
                });
            });

        });
    </script>
@endpush
