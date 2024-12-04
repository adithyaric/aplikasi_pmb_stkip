@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Mahasiswa</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--<a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">-->
                        <!--    <i class="fa fa-plus"></i> Mahasiswa-->
                        <!--</a>-->
                        <form action="">
                            <div class="row">
                                <div class="col-md-3">
                                    <select name="gelombang_id" id="" class="mb-3 form-control">
                                        <option value="" readonly>-- Pilih Gelombang --</option>
                                        @foreach ($gelombangs as $gelombang)
                                            <option value="{{ $gelombang->id }}"
                                                {{ request('gelombang_id') == $gelombang->id ? 'selected' : '' }}>
                                                {{ $gelombang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="jurusan_id" id="" class="mb-3 form-control">
                                        <option value="" readonly>-- Pilih Jurusan --</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}"
                                                {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control mb-3" placeholder="Cari Nama, Phone, Asal Sekolah"
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-default">Cari</button>
                                    <a href="{{ route('admin.excel.cetak', ['gelombang_id' => request('gelombang_id')]) }}" class="btn btn-success">
                                        Export Data
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped mahasiswa-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gelombang</th>
                                    <th>Jurusan</th>
                                    <th>Sekolah</th>
                                    <th>Name</th>
                                    <th>Briva</th>
                                    <th>Waktu Buat Akun</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $item)
                                    <tr>
                                        <td>{{ ($mahasiswa->currentPage() - 1) * $mahasiswa->perPage() + $loop->iteration }}</td>
                                        <td>{{ $item->gelombang?->nama }}</td>
                                        <td>{{ $item->mahasiswa->jurusan?->name }}</td>
                                        <td>{{ $item->lulusan?->asal_sekolah ?? '-' }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->transaksi?->briva ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $item->mahasiswa?->phone }}</td>
                                        <td>{{ $item->mahasiswa?->status }}</td>
                                        <td>
                                            <a href="{{ route('admin.mahasiswa.edit', $item->id) }}"
                                                class="edit btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ route('admin.mahasiswa.show', $item->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <a href="javascript:void(0)" onClick="Delete({{ $item->id }})"
                                                id="{{ $item->id }}" class="bayar btn btn-danger btn-sm">Hapus</a>

                                            @if ($item->transaksi)
                                                <a href="javascript:void(0)" onClick="Bayar({{ $item->transaksi->id }})"
                                                    id="{{ $item->transaksi->id }}"
                                                    class="bayar btn btn-info btn-sm">Bayar</a>
                                            @endif

                                            @php
                                                $whatsappLink = "https://wa.me/{$item->mahasiswa->phone}?text=SELAMAT%20PEMBAYARAN%20PENDAFTARAN%20ANDA%20TELAH%20KAMI%20TERIMA.%0ATahap%20selanjutnya%20adalah%20LOGIN%20melalui%20alamat%20https://regpmb.stkippacitan.ac.id/login%20.%0A-%20Username%20:%20{$item->nisn}%0A-%20Password%20:%20{$item->password_sementara}%0ASilahkan%20unggah%20data%20dan%20berkas%20pendaftaranmu%20segera%20untuk%20bisa%20mengikuti%20tahapan%20seleksi%20selanjutnya.%20Terima%20kasih";
                                            @endphp
                                            <a href="{{ $whatsappLink }}" target="_blank"
                                                class="btn btn-success btn-sm">Whatsapp</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
<td colspan="10">
<ul class="pagination justify-content-center">
    {{-- First Page Link --}}
    <li class="page-item {{ $mahasiswa->onFirstPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $mahasiswa->appends(request()->query())->url(1) }}">First</a>
    </li>

    {{-- Previous Page Link --}}
    <li class="page-item {{ $mahasiswa->previousPageUrl() ? '' : 'disabled' }}">
        <a class="page-link" href="{{ $mahasiswa->appends(request()->query())->previousPageUrl() ?? '#' }}" aria-label="Previous">&laquo;</a>
    </li>

    {{-- Dynamic Page Numbers --}}
    @foreach(range(1, $mahasiswa->lastPage()) as $page)
        @if($page == 1 || $page == $mahasiswa->lastPage() || abs($page - $mahasiswa->currentPage()) <= 2)
            <li class="page-item {{ $page == $mahasiswa->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $mahasiswa->appends(request()->query())->url($page) }}">{{ $page }}</a>
            </li>
        @elseif($page == 2 || $page == $mahasiswa->lastPage() - 1)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
    @endforeach

    {{-- Next Page Link --}}
    <li class="page-item {{ $mahasiswa->nextPageUrl() ? '' : 'disabled' }}">
        <a class="page-link" href="{{ $mahasiswa->appends(request()->query())->nextPageUrl() ?? '#' }}" aria-label="Next">&raquo;</a>
    </li>

    {{-- Last Page Link --}}
    <li class="page-item {{ $mahasiswa->currentPage() == $mahasiswa->lastPage() ? 'disabled' : '' }}">
        <a class="page-link" href="{{ $mahasiswa->appends(request()->query())->url($mahasiswa->lastPage()) }}">Last</a>
    </li>
</ul>
</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@push('addon-script')
    <script type="text/javascript">
        //aksi show modal edit
        function Bayar(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MEMBAYAR DATA INI!",
                icon: "info",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "transaction/" + id,
                        data: {
                            id,
                            "_token": token
                        },
                        type: 'PUT',
                        success: function(response) {
                            if (response) {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIUPDATE!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });

                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });

                            }

                        }
                    });

                } else {
                    return true;
                }
            })
        }

        //aksi delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "mahasiswa/" + id,
                        data: {
                            id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response) {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });

                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 3000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });

                            }

                        }

                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@endpush
