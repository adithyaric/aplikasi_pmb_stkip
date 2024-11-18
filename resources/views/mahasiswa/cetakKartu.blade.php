@extends('layouts.mahasiswa')
@section('content')
<section class="content">
    
    <div class="container">
           {{-- @if($mahasiswa->status == 'TES / CBT' || $mahasiswa->status == 'INTERVIEW')
    	<div class="bd">
	        <article>
                <h1 style="text-align: center;">SELAMAT</h1>
                     <div>
                        <h1 style="text-align: center;">DATA PENDAFTARAN ANDA TELAH DIVALIDASI OLEH PANITIA PMB DAN SILAHKAN MENUNGGU INFORMASI UNTUK TAHAPAN TES SELEKSI SELANJUTNYA.</h1>
                        <p style="text-align: center;">&mdash; PMB STKIP PGRI PACITAN</p>
                    </div>
            </article>
        </div>
    	@else --}}
    	<div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Menyatakan dengan sebenar-benarnya bahwa :</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('PrintPDF') }}">
                    @csrf
                    <div class="box-body">

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Data yang diisikan pada formulir pendaftaran adalah
                                benar dan dapat dipertanggungjawabkan
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Berkas / Dokumen yang saya sertakan dalam pendaftaran
                                PMB STKIP PGRI Pacitan TA
                                2024/2025 adalah benar dan sesuai dengan berkas aslinya.
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" required> Data yang telah saya submit menjadi data final yang tidak akan berubah.
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        @if ($attachment && Auth::user()->biodata)
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <br><br>
                        <div class="card">
                            <div class="card-body blink" style="border: 2px solid black; padding: 5px; width: 60%;">
                                <h4 class="text-danger">Peringatan :</h4>
                                <br>
                                <b>
                                    Sebelum klik SUBMIT, Telitilah kembali data dan berkas yang telah diisikan di
                                    aplikasi PMB ini. Data akan terkunci otomatis dan tidak dapat di buka kembali oleh
                                    Pendaftar. Terima Kasih.
                                </b>
                            </div>
                        </div>

                        @else
                        <button type="button" class="btn btn-default" data-toggle="modal"
                            data-target="#modal-default">Data Anda Belum Lengkap</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box -->
        <!-- /.col -->
      {{--  @endif --}}
    </div>
    <!-- /.row -->
</section>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Silahkan Lengkapi Data Terlebih Dahulu</h4>
            </div>
            <div class="modal-body">
                <p>Mohon Untuk Mengisi Menu <a href="{{ url('mahasiswa/data') }}">Pilih Jalur & Upload Berkas</a> Serta
                    Isi <a href="{{ url('mahasiswa/biodata') }}">Biodata</a> !</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection
