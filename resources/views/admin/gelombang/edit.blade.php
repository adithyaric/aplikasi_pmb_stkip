@extends('layouts.admin')
@section('content')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Edit Gelombang</h4>
            </div>
            <div class="box-body">
                <form action="{{ route('admin.gelombang.update', $gelombang->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <!-- Gelombang Name -->
                    <label for="nama">Gelombang</label>
                    <input onkeyup="this.value = this.value.toUpperCase();" type="text" class="form-control" required
                        name="nama" id="nama" placeholder="Masukan Gelombang"
                        value="{{ old('nama', $gelombang->nama) }}">

                    <input type="hidden" class="form-control" required name="id" value="{{ $gelombang->id }}">

                    <!-- Nominal -->
                    <label for="nominal">Biaya Pendaftaran</label>
                    <input type="text" class="form-control" required name="nominal" id="nominal"
                        placeholder="Masukan Nominal" value="{{ old('nominal', $gelombang->nominal) }}">

                    <!-- Status -->
                    <label for="status">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="">Pilih Status</option>
                        <option {{ $gelombang->status == 1 ? 'selected' : '' }} value="1">Aktif</option>
                        <option {{ $gelombang->status == 0 ? 'selected' : '' }} value="0">Non Aktif</option>
                    </select>

                    <!-- Tahun -->
                    <label for="tahun_id">Tahun</label>
                    <select name="tahun_id" id="tahun_id" class="mt-1 form-control" required>
                        <option value="" readonly>-- Pilih Tahun --</option>
                        @foreach ($tahuns as $tahun)
                            <option value="{{ $tahun->id }}" {{ $gelombang->tahun_id == $tahun->id ? 'selected' : '' }}>
                                {{ $tahun->status ? 'aktif' : 'non-aktif' }}: {{ $tahun->nama }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Jurusan -->
                    <label for="jurusan">Jurusan</label>
                    <select name="jurusan[]" id="jurusan" class="form-control select2" multiple>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}"
                                {{ in_array($jurusan->id, $gelombang->jurusan->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $jurusan->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Kelas -->
                    <label for="kelas">Kelas</label>
                    <select name="kelas[]" id="kelas" class="form-control select2" multiple>
                        @foreach ($kelas as $kls)
                            <option value="{{ $kls->id }}"
                                {{ in_array($kls->id, $gelombang->kelas->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $kls->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Penerimaan -->
                    <label for="penerimaan">Penerimaan</label>
                    <select name="penerimaan[]" id="penerimaan" class="form-control select2" multiple>
                        @foreach ($penerimaans as $penerimaan)
                            <option value="{{ $penerimaan->id }}"
                                {{ in_array($penerimaan->id, $gelombang->penerimaan->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $penerimaan->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="box-footer mt-3">
                        <a href="{{ route('admin.gelombang.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih',
                allowClear: true
            });
        });
    </script>
@endpush
