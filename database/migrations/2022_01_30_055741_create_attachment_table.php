<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('penerimaan_id');
            $table->text('kartu_keluarga')->nullable();
            $table->text('nisn')->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->text('pas_poto')->nullable();
            $table->text('rapor')->nullable();
            $table->text('kip')->nullable();
            $table->text('prestasi')->nullable();
            $table->text('sktm')->nullable();
            $table->text('ktp_ortu')->nullable();
            $table->text('ijazah')->nullable();
            $table->text('skot')->nullable();
            $table->text('hafidz')->nullable();

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
        Schema::dropIfExists('attachment');
    }
}
