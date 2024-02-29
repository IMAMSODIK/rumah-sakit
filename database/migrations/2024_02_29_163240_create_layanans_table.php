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
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id');
            $table->boolean('triase')->nullable(0);
            $table->time('time_triase')->nullable();
            $table->boolean('spri')->nullable(0);
            $table->time('time_spri')->nullable();
            $table->boolean('admisi')->nullable(0);
            $table->time('time_admisi')->nullable();
            $table->boolean('pemeriksaan_penunjang')->nullable(0);
            $table->time('time_pemeriksaan_penunjang')->nullable();
            $table->boolean('dpjp')->nullable(0);
            $table->time('time_dpjp')->nullable();
            $table->boolean('transfer_pasien')->nullable(0);
            $table->time('time_transfer_pasien')->nullable();
            $table->boolean('ketersediaan_ruang')->nullable(0);
            $table->time('time_ketersediaan_ruang')->nullable();
            $table->boolean('masuk_ruang')->nullable(0);
            $table->time('time_masuk_ruang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
