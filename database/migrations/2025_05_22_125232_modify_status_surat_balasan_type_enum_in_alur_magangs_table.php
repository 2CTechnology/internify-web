<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         DB::statement("ALTER TABLE alur_magangs MODIFY status_surat_balasan ENUM('menunggu konfirmasi', 'diterima', 'mengulang') DEFAULT 'menunggu konfirmasi'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Kembalikan ke tipe sebelumnya jika perlu
    DB::statement("ALTER TABLE alur_magangs MODIFY status_surat_balasan TINYINT(1) NULL");
    }
};
