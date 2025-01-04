<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserEmailUnique extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the unique constraint back if needed
            $table->unique('email');
        });
    }
}
