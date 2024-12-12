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
        <div class="row">
            <div class="col-xs-12">
                <div class="box container">
                    <h5>Edit Data</h5>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('mahasiswa.update.data') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group @error('jalur') has-error @enderror">
                                <label for="jalur">Kelas</label>
                                <select required name="jalur" class="form-control" id="jalur">
                                    <option value="" readonly>Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->name }}"
                                            {{ $mahasiswa->jalur == $k->name ? 'selected' : '' }}>
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
                                            {{ $mahasiswa->jurusan_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
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
                                        <option value="{{ $item->id }}"
                                            {{ $mahasiswa->penerimaan_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
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

                                    <div class="col-lg-12 persyaratan-item"
                                        data-penerimaan="{{ $syarat->penerimaan->pluck('id')->join(',') }}">
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
                                                            <img src="{{ asset('storage/' . $attachmentValue) }}"
                                                                alt="{{ $syarat->slug }}" class="img-thumbnail"
                                                                style="max-width: 150px;">
                                                        @else
                                                            <p>Preview</p>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endif

                                            <input type="{{ $syarat->input_type }}" name="{{ $syarat->slug }}"
                                                class="form-control"
                                                {{ $syarat->input_type === 'file' ? '' : 'value=' . old($syarat->slug, $attachmentValue) }}
                                                {{ $syarat->is_required ? 'required' : '' }}>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong>
                                            dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
                            <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    </div>

                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                    <a href="{{ url('mahasiswa/biodata') }}" class="btn btn-success">
                        Langkah Selanjutnya Isi Biodata (Klik Disini)
                    </a>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
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
