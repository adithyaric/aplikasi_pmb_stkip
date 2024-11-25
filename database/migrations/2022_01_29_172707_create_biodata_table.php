<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('nik')->nullable();
            $table->string('name')->nullable();
            $table->string('pas_photo')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->integer('anak')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->string('status_sipil')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('pemberi_rekomendasi')->nullable();
            $table->string('nama_rekomendasi')->nullable();
            $table->string('wa_rekomendasi')->nullable();
            $table->string('prodi_perekom')->nullable();
            $table->string('nim_perekom')->nullable();
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
        Schema::dropIfExists('biodata');
    }
}
