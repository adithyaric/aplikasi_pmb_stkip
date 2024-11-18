<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('rencana_tinggal');
            $table->string('transport');
            $table->string('jarak_tempuh');
            $table->string('asal_pembiayaan');
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
        Schema::dropIfExists('rencana');
    }
}
