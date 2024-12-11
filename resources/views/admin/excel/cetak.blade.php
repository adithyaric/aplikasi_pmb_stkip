<table>
    <tr>
        <td>No</td>
        <td>Gelombang</td>
        <td>Nama</td>
        <td>No Pendaftaran</td>
        <td>NISN</td>
        <td>NIK</td>
        <td>Jenis Kelamin</td>
        <td>Tempat Lahir</td>
        <td>Tanggal Lahir</td>
        <td>Agama</td>
        <td>Nomor HP</td>
        <td>Nomor HP Orang Tua</td>
        <td>Email</td>
        <td>Kewarganegaraan</td>
        <td>Jumlah Saudara</td>
        <td>Anak Ke</td>
        <td>RT</td>
        <td>RW</td>
        <td>Dusun</td>
        <td>Desa</td>
        <td>Kecamatan</td>
        <td>Kabupaten</td>
        <td>Provinsi</td>
        <td>Alamat Lengkap</td>
        <td>Sekolah Asal</td>
        <td>NPSN Sekolah Asal</td>
        <td>Tahun Lulus</td>
        <td>Alamat Sekolah</td>
        <td>Kabupaten Sekolah</td>
        <td>Provinsi Sekolah</td>
        <td>Rencana Tinggal</td>
        <td>Transportasi</td>
        <td>Jarak Tempuh</td>
        <td>Asal Pembiayaan</td>
        <td>Nomor KK</td>
        <td>Nama Ayah</td>
        <td>Pekerjaan Ayah</td>
        <td>Nama Ibu</td>
        <td>Pekerjaan Ibu</td>
        <td>No KIP</td>
        <td>No Pendaftaran KIP</td>
        <td>Kode Akses KIP</td>
        <td>No KKS</td>
        <td>No PKH</td>
        <td>Perekom</td>
        <td>Nama Perekom</td>
        <td>No HP Perekom</td>
        <td>Prodi Perekom</td>
        <td>NIM Perekom</td>
        <td>Nomor Briva</td>
        <td>Status Bayar</td>
        <td>Status Berkas</td>
        <td>Prodi Pilihan Pertama</td>
        <td>Prodi Pilihan Kedua</td>
        <td>Penerimaan</td>
        <td>Kelas</td>
        <td>kartu_keluarga</td>
        <td>nisn</td>
        <td>bukti_pembayaran</td>
        <td>pas_poto</td>
        <td>rapor</td>
        <td>kip</td>
        <td>prestasi</td>
        <td>sktm</td>
        <td>ktp_ortu</td>
        <td>ijazah</td>
        <td>skot</td>
        <td>hafidz</td>
        <td>pdu</td>
    </tr>

    @foreach ($data as $dt)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ @$dt->gelombang->nama }}</td>
        <td>{{ @$dt->name }}</td>
        <td>{{ @$dt->transaksi?->no_transaksi }}</td>
        <td>{{ @$dt->nisn }}</td>
        <td>{{ @$dt->biodata?->nik }}</td>
        <td>{{ @$dt->biodata?->jenis_kelamin }}</td>
        <td>{{ @$dt->biodata?->tempat_lahir }}</td>
        <td>{{ @$dt->biodata?->tanggal_lahir }}</td>
        <td>{{ @$dt->biodata?->agama }}</td>
        <td>{{ @$dt->mahasiswa?->phone }}</td>
        <td>{{ @$dt->biodata?->phone_ortu }}</td>
        <td>{{ @$dt->email }}</td>
        <td>{{ @$dt->biodata?->status_sipil }}</td>
        <td>{{ @$dt->biodata?->jumlah_saudara }}</td>
        <td>{{ @$dt->biodata?->anak }}</td>
        <td>{{ @$dt->alamat?->RT }}</td>
        <td>{{ @$dt->alamat?->RW }}</td>
        <td>{{ @$dt->alamat?->dusun }}</td>
        <td>{{ @$dt->alamat?->desa }}</td>
        <td>{{ @$dt->alamat?->kecamatan }}</td>
        <td>{{ @$dt->alamat?->kabupaten }}</td>
        <td>{{ @$dt->alamat?->provinsi }}</td>
        <td>{{ @$dt->alamat?->jalan }}</td>
        <td>{{ @$dt->lulusan?->asal_sekolah }}</td>
        <td>{{ @$dt->lulusan?->npsn }}</td>
        <td>{{ @$dt->lulusan?->tahun_lulus }}</td>
        <td>{{ @$dt->lulusan?->alamat_sekolah }}</td>
        <td>{{ @$dt->lulusan?->kab_sekolah }}</td>
        <td>{{ @$dt->lulusan?->prov_sekolah }}</td>
        <td>{{ @$dt->rencana?->rencana_tinggal }}</td>
        <td>{{ @$dt->rencana?->transport }}</td>
        <td>{{ @$dt->rencana?->jarak_tempuh }}</td>
        <td>{{ @$dt->rencana?->asal_pembiayaan }}</td>
        <td>{{ @$dt->pemilikkartu?->noKK }}</td>
        <td>{{ @$dt->pemilikkartu?->nama_kk }}</td>
        <td>{{ @$dt->pemilikkartu?->pekerjaan_ayah }}</td>
        <td>{{ @$dt->pemilikkartu?->nama_ibu }}</td>
        <td>{{ @$dt->pemilikkartu?->pekerjaan_ibu }}</td>
        <td>{{ @$dt->pemilikkartu?->kip }}</td>
        <td>{{ @$dt->pemilikkartu?->np_kip }}</td>
        <td>{{ @$dt->pemilikkartu?->ka_kip }}</td>
        <td>{{ @$dt->pemilikkartu?->kks }}</td>
        <td>{{ @$dt->pemilikkartu?->pkh }}</td>
        <td>{{ @$dt->biodata?->pemberi_rekomendasi }}</td>
        <td>{{ @$dt->biodata?->nama_rekomendasi }}</td>
        <td>{{ @$dt->biodata?->wa_rekomendasi }}</td>
        <td>{{ @$dt->biodata?->prodi_perekom }}</td>
        <td>{{ @$dt->biodata?->nim_perekom }}</td>
        <td>{{ @$dt->transaksi?->briva }}</td>
        <td>{{ @$dt->transaksi?->status }}</td>
        <td>{{ @$dt->mahasiswa?->status }}</td>
        <td>{{ @$dt->mahasiswa?->jurusan->name }}</td>
        <td>{{ @$dt->biodata?->jurusan_dua }}</td>
        <td>{{ @$dt->mahasiswa?->penerimaan?->name }}</td>
        <td>{{ @$dt->mahasiswa?->jalur }}</td>
        <td>{{ @$dt->attact?->kartu_keluarga }}</td>
        <td>{{ @$dt->attact?->nisn }}</td>
        <td>{{ @$dt->attact?->bukti_pembayaran }}</td>
        <td>{{ @$dt->attact?->pas_poto }}</td>
        <td>{{ @$dt->attact?->rapor }}</td>
        <td>{{ @$dt->attact?->kip }}</td>
        <td>{{ @$dt->attact?->prestasi }}</td>
        <td>{{ @$dt->attact?->sktm }}</td>
        <td>{{ @$dt->attact?->ktp_ortu }}</td>
        <td>{{ @$dt->attact?->ijazah }}</td>
        <td>{{ @$dt->attact?->skot }}</td>
        <td>{{ @$dt->attact?->hafidz }}</td>
        <td>{{ @$dt->attact?->pdu }}</td>
    </tr>
    @endforeach
</table>
