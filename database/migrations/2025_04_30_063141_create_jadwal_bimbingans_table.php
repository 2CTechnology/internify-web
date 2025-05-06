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
        Schema::create('jadwal_bimbingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelompok'); // Relasi ke tabel kelompoks
            $table->dateTime('jadwal')->nullable();    // Kolom jadwal
            $table->text('catatan')->nullable();       // Kolom catatan
            $table->timestamps();

            // Relasi ke tabel kelompoks
            $table->foreign('id_kelompok')
                ->references('id')
                ->on('kelompoks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_bimbingans');
    }
};