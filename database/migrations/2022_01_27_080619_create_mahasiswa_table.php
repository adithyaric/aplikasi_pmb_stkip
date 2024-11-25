<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('phone')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('status', ['DALAM PROSES', 'BAYAR OK', 'BERKAS LENGKAP', 'TES', 'DITERIMA', 'DITOLAK'])->nullable();
            // $table->string('jalur')->nullable();
            // $table->integer('jurusan_id')->unsigned()->nullable();
            // $table->integer('penerimaan_id')->unsigned()->nullable();
            $table->integer('gelombang_id')->unsigned()->nullable();
            $table->string('jurusan_dua')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
