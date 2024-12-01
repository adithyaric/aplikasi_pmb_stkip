<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelombangPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelombang_penerimaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gelombang_id')->constrained()->onDelete('cascade');
            $table->foreignId('penerimaan_id')->constrained('jalur_penerimaan')->onDelete('cascade');
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
        Schema::dropIfExists('gelombang_penerimaan');
    }
}
