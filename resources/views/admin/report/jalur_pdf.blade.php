<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>LAPORAN-PER-JALUR-{{ request('jalur') }}</title>
</head>

<body>
    <table class="table table-borderless">
        <tr>
            <td width="20%"><img style="margin-left: 20px; margin-top: 15px;"
                    src="https://entripmb.stkippacitan.ac.id/assets/img/stkip.png" width="100%"></td>
            <td width="80%">
                <p style="font-size: 16px; text-align: center; margin-left: -20px;"><br> PERKUMPULAN PENYELENGGARA
                    LEMBAGA PENDIDIKAN <br> PERGURUAN TINGGI PGRI PACITAN <br><b>STKIP PGRI PACITAN</b></p>
                <p style="font-size: 10px; text-align: center; margin-top: -15px; margin-left: -20px;"> Alamat: Kampus
                    PENDIDIK .Jln. Cut Nya Dien No 4A Ploso, Pacitan 63515 <br> Pos-el: info@stkippacitan.ac.id Telp
                    (0357) 881488 Fax (0357) 884742 </p>
            </td>
        </tr>
    </table>
    <hr style="border-color: black; border: 2px; margin-top: -30px;">
    <p style="font-size: 14px; font-weight: bold; text-align: center; margin-top: -10px;">LAPORAN DATA MAHASISWA JALUR (
        <b>{{ request('jalur') }}</b> )</p>
    <p style="font-size: 12px !important;">
        Total Data :&nbsp; <b>{{ $mahasiswa->count() }}</b>
    </p>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th width="5%" style="font-size: 12px !important;">No</th>
                <th style="font-size: 12px !important;">NISN</th>
                <th style="font-size: 12px !important;">Nama Mahasiswa</th>
                <th style="font-size: 12px !important;">Program Studi</th>
                <th style="font-size: 12px !important;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $index => $key)
            <tr>
                <td style="font-size: 11px !important; text-align: center;">{{ $index + 1 }}</td>
                <td style="font-size: 11px !important;">{{ $key->nisn }}</td>
                <td style="font-size: 11px !important;">{{ $key->name }}</td>
                <td style="font-size: 11px !important;">{{ $key->mahasiswa->jurusan->name }}</td>
                <td style="font-size: 11px !important;">{{ $key->mahasiswa->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{-- <div class="text-center">
        <img src="https://entripmb.stkippacitan.ac.id/assets/img/pmb.jpg" width="70px">
    </div> --}}


    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script> --}}
</body>

</html>
