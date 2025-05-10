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
        Schema::create('evaluasi_magangs', function (Blueprint $table) {
            $table->id(); // id utama
            $table->unsignedBigInteger('tempat_magang_id'); // Foreign Key ke tempat_magang
            $table->date('tanggal'); // Tanggal evaluasi
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->timestamps(); // created_at dan updated_at

            // Menambahkan foreign key constraint
            $table->foreign('tempat_magang_id')->references('id')->on('tempat_magangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasi_magangs');
    }
};
