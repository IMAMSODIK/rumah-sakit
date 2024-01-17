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
        Schema::create('tahapans', function (Blueprint $table) {
            $table->id();
            $table->string('jam_pertama');
            $table->string('jam_kedua');
            $table->string('jam_ketiga');
            $table->string('jam_keempat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahapans');
    }
};
