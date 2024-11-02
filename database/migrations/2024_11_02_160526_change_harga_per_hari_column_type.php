<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedBigInteger('harga_per_hari')->change();
        });
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedSmallInteger('harga_per_hari')->change();
        });
    }
};