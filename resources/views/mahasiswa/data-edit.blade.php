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
                                {{-- #TODO hardcoded --}}
                                <label for="penerimaan_id">Jalur Penerimaan</label>
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
                                        {{-- <option value="{{ $item->id }}">{{ $item->name }}</option> --}}
                                    @endforeach
                                </select>
                                @error('penerimaan_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="data" id="Biodata"></div>
                            <p><strong>Note : <strong><i>File upload harus berformat <strong>"PDF/PNG/JPG/JPEG"</strong> dengan ukuran <strong>maksimal 3 MB (Total Semua Berkas)</strong></i></p>
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
                            $('#Biodata').append(`
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>${item.name}</label>
                                        <input type="${item.input_type}" name="${item.name}" class="form-control" ${item.input_type === 'file' ? 'required' : ''}>
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
