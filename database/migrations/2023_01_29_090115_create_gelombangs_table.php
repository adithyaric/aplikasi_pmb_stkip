<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelombangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelombangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->bigInteger('nominal')->nullable()->default(0);
            $table->string('status')->nullable(false)->default('1');
            $table->integer('tahun_id')->unsigned()->nullable();
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
        Schema::dropIfExists('gelombangs');
    }
}
