<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('address');
            $table->unsignedSmallInteger('luas')->default(0);
            $table->unsignedSmallInteger('wifi_speed')->default(0);
            $table->unsignedSmallInteger('kapasitas')->default(0);
            $table->unsignedSmallInteger('harga_per_hari')->default(0);
            $table->longText('foto')->nullable();
            $table->unsignedSmallInteger('full_support')->default(0);
            $table->unsignedSmallInteger('tersedia_mini_cafe')->default(0);
            $table->unsignedSmallInteger('tersedia_gym')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
