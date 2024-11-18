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
            $table->string('nik');
            $table->string('name');
            $table->string('pas_photo');
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('agama');
            $table->integer('anak');
            $table->integer('jumlah_saudara');
            $table->string('status_sipil');
            $table->string('phone');
            $table->string('email');
            $table->string('pemberi_rekomendasi');
            $table->string('nama_rekomendasi');
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
