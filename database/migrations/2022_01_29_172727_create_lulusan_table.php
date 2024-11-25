<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLulusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lulusan', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('nisn')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('npsn')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('kab_sekolah')->nullable();
            $table->string('prov_sekolah')->nullable();
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
        Schema::dropIfExists('lulusan');
    }
}
