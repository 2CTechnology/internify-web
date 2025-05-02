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
            $table->unsignedBigInteger('id_kelompok'); // Kolom id_kelompok yang mengacu ke tabel anggotas
            $table->dateTime('jadwal')->nullable();    // Kolom jadwal
            $table->text('catatan')->nullable();       // Kolom catatan
            $table->timestamps();

            // Relasi dengan tabel anggotas
            $table->foreign('id_kelompok')
                ->references('id_kelompok')
                ->on('anggotas')
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