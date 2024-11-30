<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GelombangJurusan extends Migration
{
    public function up()
    {
        Schema::create('gelombang_jurusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gelombang_id')->constrained()->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gelombang_jurusan');
    }
}
