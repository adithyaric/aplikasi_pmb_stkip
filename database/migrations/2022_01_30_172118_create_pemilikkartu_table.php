<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemilikkartuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilikkartu', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('noKK');
            $table->string('nama_kk');
            $table->string('kip')->nullable();
            $table->string('kks')->nullable();
            $table->string('pkh')->nullable();

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
        Schema::dropIfExists('pemilikkartu');
    }
}
