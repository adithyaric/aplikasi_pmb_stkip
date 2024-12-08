<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRequiredToPersyaratanTable extends Migration
{
    public function up()
    {
        Schema::table('persyaratans', function (Blueprint $table) {
            $table->boolean('is_required')->nullable()->default(true);
        });
    }

    public function down()
    {
        Schema::table('persyaratans', function (Blueprint $table) {
            $table->dropColumn('is_required');
        });
    }
}
