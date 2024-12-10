<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewStatusesToMahasiswa extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            DB::statement("ALTER TABLE mahasiswa MODIFY status ENUM('DALAM PROSES', 'BAYAR OK', 'BERKAS LENGKAP', 'TES', 'DITERIMA', 'DITOLAK', 'MAHASISWA DITERIMA', 'DAFTAR ULANG') NULL");
        });
    }

    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            DB::statement("ALTER TABLE mahasiswa MODIFY status ENUM('DALAM PROSES', 'BAYAR OK', 'BERKAS LENGKAP', 'TES', 'DITERIMA', 'DITOLAK') NULL");
        });
    }
}
