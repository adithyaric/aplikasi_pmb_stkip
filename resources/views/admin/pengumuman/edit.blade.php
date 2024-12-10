@extends('layouts.admin')
@section('content')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section class="content">
<div class="box">
    <div class="box-header">
        <h4 class="box-title">Edit Pengumuman</h4>
    </div>
    <div class="box-body">
        <label for="gelombangs">Gelombang</label>
        <form action="{{ route('admin.pengumuman.store') }}" method="post">
            @csrf

            <select name="gelombangs[]" id="gelombangs" class="form-control select2" multiple required>
                @foreach ($gelombangs as $gelombang)
                    <option value="{{ $gelombang->id }}" {{ in_array($gelombang->id, $pengumuman->gelombangs->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $gelombang->nama }}
                    </option>
                @endforeach
            </select>

            <div class="form-group @error('title') has-error @enderror">
                <label for="title">Pengumuman</label>
                <input type="text" class="form-control" required name="title" id="edit-title" value="{{ old('title', $pengumuman->title) }}" placeholder="Masukan Pengumuman">
                <input type="hidden" class="form-control" required name="id" id="id" value="{{ $pengumuman->id }}">
            </div>
            <div class="form-group">
                <label for="content">Isi Pengumuman</label>
                <div id="editor-container" style="height: 200px;">
                    {!! old('title', $pengumuman->content) !!}
                </div>
                <input type="hidden" name="content" id="content">
            </div>
            <div class="form-group">
                <label for="date_start">Tanggal Mulai</label>
                <input type="text" class="form-control" required value="{{ old('title', $pengumuman->date_start) }}" name="date_start" id="edit-date_start">
            </div>
            <div class="form-group">
                <label for="date_end">Tanggal Berakhir</label>
                <input type="text" class="form-control" required value="{{ old('title', $pengumuman->date_end) }}" name="date_end" id="edit-date_end">
            </div>

            <div class="box-footer">
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary">Kembali</a>
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
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script type="text/javascript">
    // Initialize Quill
    var quill = new Quill('#editor-container', {
        theme: 'snow'
    });

    $('form').on('submit', function(e) {
        $('#content').val(quill.root.innerHTML); // Get Quill editor content
    });

    // Initialize Date Range Picker
    $('input[name="date_start"], input[name="date_end"]').daterangepicker({
        autoApply: true,
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    $('input[name="date_start"], input[name="date_end"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });
</script>

@endpush
