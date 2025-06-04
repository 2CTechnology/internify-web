<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ploting_dosen');
            $table->unsignedBigInteger('id_kelompok');
            $table->unsignedBigInteger('id_tempat_magang');
            $table->string('tahun', 4);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_ploting_dosen')->references('id')->on('ploting_dosens')->onDelete('cascade');
            $table->foreign('id_kelompok')->references('id')->on('kelompoks')->onDelete('cascade');
            $table->foreign('id_tempat_magang')->references('id')->on('tempat_magangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};