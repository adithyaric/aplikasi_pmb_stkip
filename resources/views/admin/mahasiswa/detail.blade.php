@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Detail Mahasiswa</small>
    </h1>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-md-7">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">BIODATA</a></li>
                                <li><a href="#tab_2" data-toggle="tab">ALAMAT (Sesuai KTP)</a></li>
                                <li><a href="#tab_3" data-toggle="tab">SEKOLAH / LULUSAN</a></li>
                                <li><a href="#tab_4" data-toggle="tab">RENCANA</a></li>
                                <li><a href="#tab_5" data-toggle="tab">KELUARGA & KARTU</a></li>
                                <li><a href="#tab_6" data-toggle="tab">PEREKOM</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">

                                    <div class="form-group row">
                                        <label class="col-md-4">NIK</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->nik }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nama Lengkap</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->name }}</p>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4">Jenis Kelamin</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->jenis_kelamin }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Tempat Lahir</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->tempat_lahir }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Tanggal Lahir</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->tanggal_lahir }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Agama</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->agama }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Anak</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->anak }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Jumlah Saudara</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->jumlah_saudara }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Status Kewarganegaraan</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->status_sipil }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nomor Hp</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->phone }}</p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Email</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">{{ @$mahasiswa->biodata->email }}</p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <!-- <div class="form-group row">
                                        <label class="col-md-4">RT </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->RT }}
                                        </p>
                                    </div> -->
                                   <!--  <div class="form-group row">
                                        <label class="col-md-4">RW </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->RW }}
                                        </p>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                        <label class="col-md-4">DUSUN </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->dusun }}
                                        </p>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                        <label class="col-md-4">DESA </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->desa }}
                                        </p>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                        <label class="col-md-4">KECAMATAN </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->kecamatan }}
                                        </p>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-md-4">NAMA JALAN </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->jalan }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">KABUPATEN </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->kabupaten }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">PROVINSI </label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->alamat->provinsi }}
                                        </p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="form-group row">
                                        <label class="col-md-4">NISN :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->nisn }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">TAHUN LULUS :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->tahun_lulus }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">ASAL SEKOLAH :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->asal_sekolah }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">NPSN :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->npsn }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">ALAMAT SEKOLAH :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->alamat_sekolah }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">KABUPATEN SEKOLAH :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->kab_sekolah }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">PROVINSI SEKOLAH :</label>
                                        <div class="col-md-1">:</div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->lulusan->prov_sekolah }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_4">
                                    <div class="form-group row">
                                        <label class="col-md-4">RENCANA TINGGAL </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->rencana->rencana_tinggal }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">ALAT TRANSPORTASI </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->rencana->transport }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">JARAK TEMPUH</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->rencana->jarak_tempuh }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">ASAL PEMBIAYAAN</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->rencana->asal_pembiayaan }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_5">
                                    <div class="form-group row">
                                        <label class="col-md-4">NO KK </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->noKK }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">NAMA AYAH </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->nama_kk }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">PEKERJAAN AYAH </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->pekerjaan_ayah }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">NAMA IBU </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->nama_ibu }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">PEKERJAAN IBU </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->pekerjaan_ibu }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nomor KIP </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->kip }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nomor Pendaftaran KIP-K </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->np_kip }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Kode Akses KIP-K </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->ka_kip }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nomor KKS </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->kks }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nomor PKH </label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->pemilikkartu->pkh }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_6">
                                    <div class="form-group row">
                                        <label class="col-md-4">Pemberi Rekomendasi</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->pemberi_rekomendasi }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Nama Rekomendasi</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->nama_rekomendasi }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">No HP Perekom</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->wa_rekomendasi }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Prodi Perekom</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->prodi_perekom }}
                                        </p>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">NIM Perekom</label>
                                        <div class="col-md-1">
                                            :
                                        </div>
                                        <p class="text-muted col-md-4">
                                            {{ @$mahasiswa->biodata->nim_perekom }}
                                        </p>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->

                        <a href="{{ route('admin.mahasiswa.index') }}">&nbsp;&nbsp; <span
                                class="glyphicon glyphicon-arrow-left"></span> &nbsp; Kembali ke Halaman sebelumnya</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Jurusan</h5>
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <table class="table">
                                    <tr>
                                        <th width="30%">Kelas</th>
                                        <td width="10%" class="text-center">:</td>
                                        <td>
                                            {{ $mahasiswa->mahasiswa->jalur }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan 1</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ @$mahasiswa->mahasiswa->jurusan->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jurusan 2</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ @$mahasiswa->biodata->jurusan_dua }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jalur Penerimaan</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            {{ @$mahasiswa->attact->penerimaan->name }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Data File Dokumen</h5>
                            </div>
                            <div class="panel-body" style="padding: 0px;">
                                <table class="table">
                                    <tr>
                                        <th width="30%">Kartu Keluarga</th>
                                        <td width="10%" class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->kartu_keluarga)
                                            <a href="{{ \Storage::url($mahasiswa->attact->kartu_keluarga) }}"
                                                target="__bspanlank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NISN</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->nisn)
                                            <a href="{{ \Storage::url($mahasiswa->attact->nisn) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->bukti_pembayaran)
                                            <a href="{{ \Storage::url($mahasiswa->attact->bukti_pembayaran) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pass Foto</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->pas_poto)
                                            <a href="{{ \Storage::url($mahasiswa->attact->pas_poto) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rapor / Undangan</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->rapor)
                                            <a href="{{ \Storage::url($mahasiswa->attact->rapor) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>KIP, PKH, KKS , Penghasilan </th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->kip)
                                            <a href="{{ \Storage::url($mahasiswa->attact->kip) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Prestasi</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->prestasi)
                                            <a href="{{ \Storage::url($mahasiswa->attact->prestasi) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>SKTM</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->sktm)
                                            <a href="{{ \Storage::url($mahasiswa->attact->sktm) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>KTP Orang Tua & Pendaftar</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->ktp_ortu)
                                            <a href="{{ \Storage::url($mahasiswa->attact->ktp_ortu) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ijazah</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->ijazah)
                                            <a href="{{ \Storage::url($mahasiswa->attact->ijazah) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>SKOT</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->skot)
                                            <a href="{{ \Storage::url($mahasiswa->attact->skot) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Hafidz</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->hafidz)
                                            <a href="{{ \Storage::url($mahasiswa->attact->hafidz) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Potongan DU</th>
                                        <td class="text-center">:</td>
                                        <td>
                                            @if (@$mahasiswa->attact->pdu)
                                            <a href="{{ \Storage::url($mahasiswa->attact->pdu) }}"
                                                target="__blank">Lihat
                                                File Lampiran <span class="glyphicon glyphicon-new-window"></span></a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
