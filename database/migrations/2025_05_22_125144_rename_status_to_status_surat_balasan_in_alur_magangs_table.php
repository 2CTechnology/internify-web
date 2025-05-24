<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah nama kolom 'status' ke 'status_surat_balasan' secara manual (asumsikan VARCHAR(50))
        DB::statement("ALTER TABLE `alur_magangs` CHANGE `status` `status_surat_balasan` VARCHAR(50) NULL");
    }

    public function down(): void
    {
        // Balikkan nama kolom jika rollback
        DB::statement("ALTER TABLE `alur_magangs` CHANGE `status_surat_balasan` `status` VARCHAR(50) NULL");
    }
};
