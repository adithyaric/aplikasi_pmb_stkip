@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Mahasiswa {{ $gelombang->nama }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                        <h3>{{ $diterima }}</h3>
                        <p>Mahasiswa Diterima</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-android-checkmark-circle"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-gradient">
                    <div class="inner">
                        <h3>{{ $berkas }}</h3>
                        <p>Berkas Lengkap</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-android-document"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h3>{{ $bayar }}</h3>
                        <p>Mahasiswa Bayar</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-cash"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-black-gradient">
                    <div class="inner">
                        <h3>{{ $pendaftar }}</h3>
                        <p>Pendaftaran Mahasiswa</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-clipboard"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green-gradient">
                    <div class="inner">
                        <h3>{{ $cbt }}</h3>
                        <p>Mahasiswa TES / CBT</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-compose"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red-gradient">
                    <div class="inner">
                        <h3>{{ $interview }}</h3>
                        <p>Mahasiswa Interview</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-ios-flag-outline"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-black-gradient">
                    <div class="inner">
                        <h3>{{ $keluar }}</h3>
                        <p>Mahasiswa Keluar</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="ion ion-ios-flag-outline"></i> --}}
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--<a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">-->
                        <!--    <i class="fa fa-plus"></i> Mahasiswa-->
                        <!--</a>-->
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="jurusan_id" id="" class="mb-3 form-control">
                                        <option value="" readonly>-- Pilih Jurusan --</option>
                                        @foreach ($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}"
                                                {{ request('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="penerimaan_id" id="" class="mb-3 form-control">
                                        <option value="" readonly>-- Pilih Penerimaan --</option>
                                        @foreach ($penerimaans as $penerimaan)
                                            <option value="{{ $penerimaan->id }}"
                                                {{ request('penerimaan_id') == $penerimaan->id ? 'selected' : '' }}>
                                                {{ $penerimaan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-default">Cari</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('admin.excel.cetak', ['gelombang_id' => $gelombang->id]) }}"
                                        class="btn btn-success">
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
                                    <th>Sekolah</th>
                                    <th>Name</th>
                                    <th>Briva</th>
                                    <th>Waktu Buat Akun</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>transaksi</th>
                                    <th>jurusan</th>
                                    <th>penerimaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($mahasiswa as $siswa)
                                {{-- @isset($siswa->transaksi) --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->lulusan->asal_sekolah ?? '-' }}</td>
                                        <td>{{ $siswa->name }}</td>
                                        <td>{{ $siswa->transaksi?->briva }}</td>
                                        <td>{{ $siswa->created_at }}</td>
                                        <td>{{ $siswa->mahasiswa->phone }}</td>
                                        <td>{{ $siswa->mahasiswa->status }}</td>
                                        <td>{{ $siswa->transaksi?->status }}</td>
                                        <td>{{ $siswa->mahasiswa->jurusan?->name }}</td>
                                        <td>{{ $siswa->mahasiswa->penerimaan?->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.mahasiswa.edit', $siswa->id) }}"
                                                class="edit btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ route('admin.mahasiswa.show', $siswa->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <a href="javascript:void(0)" onClick="Delete(this.id)"
                                                id="{{ $siswa->transaksi?->id }}" class="delete btn btn-danger btn-sm">
                                                Hapus</a>
                                            <a href="javascript:void(0)" onClick="Bayar(this.id)"
                                                id="{{ $siswa->transaksi?->id }}" class="bayar btn btn-info btn-sm">Bayar</a>
                                            <a href="https://wa.me/{{ $siswa->mahasiswa->phone }}?text=SELAMAT%20PEMBAYARAN%20PENDAFTARAN%20ANDA%20TELAH%20KAMI%20TERIMA.%0ATahap%20selanjutnya%20adalah%20LOGIN%20melalui%20alamat%20https://regpmb.stkippacitan.ac.id/login%20.%0A-%20Username%20:%20{{ $siswa->nisn }}%0A-%20Password%20:%20{{ $siswa->password_sementara }}%0ASilahkan%20unggah%20data%20dan%20berkas%20pendaftaranmu%20segera%20untuk%20bisa%20mengikuti%20tahapan%20seleksi%20selanjutnya.%20Terima%20kasih"
                                                target="_blank" class="btn btn-success btn-sm">Whatsapp</a>
                                        </td>
                                    </tr>
                                {{-- @endisset --}}
                            @endforeach
                            <tbody>

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
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        });
        //aksi show modal edit
        function Bayar(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");
            var updateUrl = "{{ route('admin.transaction.update', ':id') }}".replace(':id', id);
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
                    console.log(updateUrl);

                    jQuery.ajax({
                        url: updateUrl,
                        data: {
                            id,
                            "_token": token
                        },
                        type: 'PUT',
                        success: function(response) {
                            console.log(token);
                            console.log(id);
                            console.log(response);
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
                                    text: 'DATA GAGAL DIUPDATE!',
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
            var destroyUrl = "{{ route('admin.transaction.destroy', ':id') }}".replace(':id', id);
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
                    jQuery.ajax({
                        url: destroyUrl,
                        // url: "mahasiswa/" + id,
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
