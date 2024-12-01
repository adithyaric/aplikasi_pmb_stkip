@extends('layouts.admin')
@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section class="content">
<div class="box">
    <div class="box-header">
        <h4 class="box-title">Edit Penerimaan</h4>
    </div>
    <div class="box-body">
        <form action="{{ route('admin.penerimaan.update', $penerimaan->id) }}" method="post">
            @method('PUT')
            @csrf

            <div class="form-group @error('name') has-error @enderror">
                <label for="name">Name</label>
                <input type="text" class="form-control" required name="name" id="name" value="{{ old('name', $penerimaan->name) }}" placeholder="Masukan Penerimaan">
            </div>

            <input type="hidden" name="id" value="{{ $penerimaan->id }}">

            <label for="persyaratans">Persyaratan</label>
            <select name="persyaratans[]" id="persyaratans" class="form-control select2" multiple required>
                @foreach ($persyaratans as $persyaratan)
                    <option value="{{ $persyaratan->id }}" {{ in_array($persyaratan->id, $penerimaan->persyaratan->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $persyaratan->name }}
                    </option>
                @endforeach
            </select>

            <label for="gelombangs">Gelombang</label>
            <select name="gelombangs[]" id="gelombangs" class="form-control select2" multiple required>
                @foreach ($gelombangs as $gelombang)
                    <option value="{{ $gelombang->id }}" {{ in_array($gelombang->id, $penerimaan->gelombang->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $gelombang->nama }}
                    </option>
                @endforeach
            </select>

            <div class="box-footer">
                <a href="{{ route('admin.penerimaan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary pull-left">Save</button>
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
