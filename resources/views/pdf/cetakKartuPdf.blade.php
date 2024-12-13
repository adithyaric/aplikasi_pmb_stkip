<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Cetak Kartu Pendaftaran!</title>
    <style>
        .gelombang-box {
            display: inline-block;
            border: 2px solid black;
            padding: 5px 15px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #ffffff;
            white-space: nowrap; /* Prevents text from wrapping */
            text-align: center;
            font-size: 13px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <table class="table table-borderless">
        <tr>
            <td width="20%"><img style="margin-left: 20px; margin-top: 15px;"
                    src="{{ public_path('assets/img/stkip.png') }}" width="100%"></td>
            <td width="80%">
                <p style="font-size: 16px; text-align: center; margin-left: -20px;"><br> PERKUMPULAN PENYELENGGARA
                    LEMBAGA PENDIDIKAN <br> PERGURUAN TINGGI PGRI PACITAN <br><b>STKIP PGRI PACITAN</b></p>
                <p style="font-size: 10px; text-align: center; margin-top: -15px; margin-left: -20px;"> Alamat: Kampus
                    PENDIDIK .Jln. Cut Nya Dien No 4A Ploso, Pacitan 63515 <br> Pos-el: info@stkippacitan.ac.id Telp
                    (0357) 881488 Fax (0357) 884742<br>Wa PMB : 0877-5511-5100 </p>
            </td>
        </tr>
    </table>
    <hr style="border-color: black; border: 2px; margin-top: -30px;">
    @if (auth()->user()->gelombang && auth()->user()->gelombang->nama)
    <div class="gelombang-box">
        {{ strtoupper(auth()->user()->gelombang->nama) }}
    </div>
    @endif
    <br>
    <br>
    <br>
    <p style="font-size: 14px; font-weight: bold; text-align: center; margin-top: -40px; margin-right: -40px;">KARTU PENDAFTARAN MAHASISWA
        BARU<br>TAHUN
        AKADEMIK {{ strtoupper(Auth::user()->gelombang?->tahun?->nama) }}</p>
    <div class="text-right">
        <img src="{{ public_path('storage/'.Auth::user()->photo) }}" style="width:125px !important;border-raidus:10px;"
            alt="">
    </div>
    <table class="table table-borderless" style="margin-top: -150px; font-family: Times New Roman; font-size: 12px;">
        <tr>
            <td width="35%">Nomor Pendaftaran</td>
            <td width="5%">:</td>
            <td>{{ $user->transaksi->no_transaksi }}</td>
        </tr>
        <tr>
            <td width="35%">Nama Pendaftar</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->name ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">NIK</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->nik ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Sekolah Asal</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->asal_sekolah ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Alamat Pendaftar</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->alamat->jalan ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nomor Telepon</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->mahasiswa->phone ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">Nomor Telepon Orang Tua</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->phone_ortu ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">Jalur Daftar</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->mahasiswa->penerimaan->name ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Program Studi 1</td>
            <td width="5%">:</td>
            <td width="60%">{{ Auth::user()->mahasiswa->jurusan->name ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Program Studi 2</td>
            <td width="5%">:</td>
            <td width="60%">{{ Auth::user()->biodata->jurusan_dua ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Kelas</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->mahasiswa->jalur ?? "-" }}</td>
        </tr>
    </table>

    <table class="table table-borderless" style="font-family: Times New Roman; font-size: 14px;">
        <thead>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td>Tanda Tangan</td>
            </tr>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td>{{ Auth::user()->biodata->name }}</td>
            </tr>
        </thead>

    </table>

    <ul style="font-family: 'Times New Roman'; font-size: 11px;">
        <li>Formulir ini adalah bukti saudara/ saudari terdaftar sebagai calon mahasiswa baru Tahun Akademik {{ strtoupper(Auth::user()->gelombang?->tahun?->nama) }}.
        </li>
        <li>Cetak kartu pendaftaran menggunakan kertas berukuran A4 (jika dibutuhkan).</li>
        <li>Kartu pendaftaran diberikan kepada pendaftar sebagai tanda bukti bahwa saudara / saudari melakukan tahap
            pendaftaran secara online.</li>
        <li>Apabila ada perubahan jadwal pelaksanaan Computer-based Test (CBT), Tes Praktek, dan Tes Wawancara, maka
            akan diinformasikan lebih lanjut.</li>
        <li>Konsultasi PMB via Whatsapp 0877-5511-5100.</li>
    </ul>

    <br>

    <div class="text-center">
        <img src="{{ public_path('assets/img/pmb1.jpg') }}" width="70px">
    </div>
    <br>

    <!-- Formulir Pendaftaran -->
    <table class="table table-borderless page-break">
        <tr>
            <td width="20%"><img style="margin-left: 20px; margin-top: 15px;"
                    src="{{ public_path('assets/img/stkip.png') }}" width="100%"></td>
            <td width="80%">
                <p style="font-size: 16px; text-align: center; margin-left: -20px;"><br> PERKUMPULAN PENYELENGGARA
                    LEMBAGA PENDIDIKAN <br> PERGURUAN TINGGI PGRI PACITAN <br><b>STKIP PGRI PACITAN</b></p>
                <p style="font-size: 10px; text-align: center; margin-top: -15px; margin-left: -20px;"> Alamat: Kampus
                    PENDIDIK .Jln. Cut Nya Dien No 4A Ploso, Pacitan 63515 <br> Pos-el: info@stkippacitan.ac.id Telp
                    (0357) 881488 Fax (0357) 884742<br>Wa PMB : 0877-5511-5100 </p>
            </td>
        </tr>
    </table>
    <hr style="border-color: black; border: 2px; margin-top: -30px;">
    @if (auth()->user()->gelombang && auth()->user()->gelombang->nama)
    <div class="gelombang-box">
        {{ strtoupper(auth()->user()->gelombang->nama) }}
    </div>
    @endif
    <br>
    <br>
    <br>
    <p style="font-size: 14px; font-weight: bold; text-align: center; margin-top: -40px; margin-right: -40px;">FORMULIR PENDAFTARAN MAHASISWA
        BARU<br>TAHUN
        AKADEMIK {{ strtoupper(Auth::user()->gelombang?->tahun?->nama) }}</p></p>
    <div class="text-right">
        <img src="{{ public_path('storage/'.Auth::user()->photo) }}" style="width:125px !important;border-raidus:10px;"
            alt="">
    </div>
    <table class="table table-borderless" style="margin-top: -150px; font-family: Times New Roman; font-size: 10px;">
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">BIODATA</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">Nama Pendaftar</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->name ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">NIK</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->nik ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">NISN</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->nisn ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Jenis Kelamin</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->jenis_kelamin ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">TTL</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->tempat_lahir ?? "-" }}, {{ Auth::user()->biodata->tanggal_lahir }}</td>
        </tr>
        <tr>
            <td width="35%">Agama</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->agama ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Anak Ke</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->anak ?? "-" }} dari {{ Auth::user()->biodata->jumlah_saudara }} bersaudara</td>
        </tr>
        <tr>
            <td width="35%">Kewarganegaraan</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->status_sipil ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nomor HP</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->mahasiswa->phone ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">Nomor Telepon Orang Tua</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->phone_ortu ?? "-" }}</td>
            <td></td>
        </tr>
        <tr>
            <td width="35%">Email</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->email ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">ALAMAT</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">Kabupaten</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->alamat->kabupaten ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Provinsi</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->alamat->provinsi ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Alamat Lengkap</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->alamat->jalan ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;"></strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;"></strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;"></strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;"></strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;"></strong>
            </td>
        </tr>
    </table>

     <!-- Formulir Pendaftaran Page 2 -->
    <table class="table table-borderless page-break">
        <tr>
            <td width="20%"><img style="margin-left: 20px; margin-top: 15px;"
                    src="{{ public_path('assets/img/stkip.png') }}" width="100%"></td>
            <td width="80%">
                <p style="font-size: 16px; text-align: center; margin-left: -20px;"><br> PERKUMPULAN PENYELENGGARA
                    LEMBAGA PENDIDIKAN <br> PERGURUAN TINGGI PGRI PACITAN <br><b>STKIP PGRI PACITAN</b></p>
                <p style="font-size: 10px; text-align: center; margin-top: -15px; margin-left: -20px;"> Alamat: Kampus
                    PENDIDIK .Jln. Cut Nya Dien No 4A Ploso, Pacitan 63515 <br> Pos-el: info@stkippacitan.ac.id Telp
                    (0357) 881488 Fax (0357) 884742<br>Wa PMB : 0877-5511-5100 </p>
            </td>
        </tr>
    </table>
    <hr style="border-color: black; border: 2px; margin-top: -30px;">
    @if (auth()->user()->gelombang && auth()->user()->gelombang->nama)
    <div class="gelombang-box">
        {{ strtoupper(auth()->user()->gelombang->nama) }}
    </div>
    @endif
    <br>
    <br>
    <br>
    <p style="font-size: 14px; font-weight: bold; text-align: center; margin-top: -40px; margin-right: -40px;">FORMULIR PENDAFTARAN MAHASISWA
        BARU<br>TAHUN
        AKADEMIK {{ strtoupper(Auth::user()->gelombang?->tahun?->nama) }}</p></p>

    <table class="table table-borderless" style="margin-top: -150px; font-family: Times New Roman; font-size: 10px;">
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">SEKOLAH</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">Sekolah Asal</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->asal_sekolah ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">NPSN</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->npsn ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Tahun Lulus</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->tahun_lulus ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Alamat Sekolah</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->alamat_sekolah ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Kabupaten Sekolah</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->kab_sekolah ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Provinsi Sekolah</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->lulusan->prov_sekolah ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">RENCANA</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">Rencana Tinggal</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->rencana->rencana_tinggal ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Alat Transportasi</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->rencana->transport ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Jarak Tempuh</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->rencana->jarak_tempuh ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Asal Pembiayaan</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->rencana->asal_pembiayaan ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">KELUARGA & KEPEMILIKAN KARTU</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">No KK</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->noKK ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nama Ayah</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->nama_kk ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Pekerjaan Ayah</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->pekerjaan_ayah ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nama Ibu</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->nama_ibu ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Pekerjaan Ibu</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->pekerjaan_ibu ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">No KIP</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->kip ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">No Pend. KIP</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->np_kip ?? "-" }}</td>
        </tr>
    </table>

    <!-- Formulir Pendaftaran Page 3 -->
    <table class="table table-borderless page-break">
        <tr>
            <td width="20%"><img style="margin-left: 20px; margin-top: 15px;"
                    src="{{ public_path('assets/img/stkip.png') }}" width="100%"></td>
            <td width="80%">
                <p style="font-size: 16px; text-align: center; margin-left: -20px;"><br> PERKUMPULAN PENYELENGGARA
                    LEMBAGA PENDIDIKAN <br> PERGURUAN TINGGI PGRI PACITAN <br><b>STKIP PGRI PACITAN</b></p>
                <p style="font-size: 10px; text-align: center; margin-top: -15px; margin-left: -20px;"> Alamat: Kampus
                    PENDIDIK .Jln. Cut Nya Dien No 4A Ploso, Pacitan 63515 <br> Pos-el: info@stkippacitan.ac.id Telp
                    (0357) 881488 Fax (0357) 884742<br>Wa PMB : 0877-5511-5100 </p>
            </td>
        </tr>
    </table>
    <hr style="border-color: black; border: 2px; margin-top: -30px;">
    @if (auth()->user()->gelombang && auth()->user()->gelombang->nama)
    <div class="gelombang-box">
        {{ strtoupper(auth()->user()->gelombang->nama) }}
    </div>
    @endif
    <br>
    <br>
    <br>
    <p style="font-size: 14px; font-weight: bold; text-align: center; margin-top: -40px; margin-right: -40px;">FORMULIR PENDAFTARAN MAHASISWA
        BARU<br>TAHUN
        AKADEMIK {{ strtoupper(Auth::user()->gelombang?->tahun?->nama) }}</p></p>

    <table class="table table-borderless" style="margin-top: -150px; font-family: Times New Roman; font-size: 10px;">
        <tr>
            <td width="35%">Kode Akses KIP</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->ka_kip ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">No KKS</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->kks ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">No PKH</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->pemilikkartu->pkh ?? "-" }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <strong style="font-size: 12px;">PEMBERI REKOMENDASI</strong>
            </td>
        </tr>
        <tr>
            <td width="35%">Pemberi Rekomendasi</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->pemberi_rekomendasi ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nama Pemberi Rekomendasi</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->nama_rekomendasi ?? "-" }}</td>
        </tr>
        <tr>
            <td width="35%">Nomor Pemberi Rekomendasi</td>
            <td width="5%">:</td>
            <td>{{ Auth::user()->biodata->wa_rekomendasi ?? "-" }}</td>
        </tr>


    </table>

    <table class="table table-borderless" style="font-family: Times New Roman; font-size: 14px;">
        <thead>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td>Tanda Tangan</td>
            </tr>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td width="35%"></td>
                <td width="5%"></td>
                <td></td>
                <td>{{ Auth::user()->biodata->name }}</td>
            </tr>
        </thead>

    </table>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
</body>

</html>
