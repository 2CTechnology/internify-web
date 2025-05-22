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
        Schema::table('alur_magangs', function (Blueprint $table) {
            $table->renameColumn('status', 'status_surat_balasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alur_magangs', function (Blueprint $table) {
            $table->renameColumn('status_surat_balasan', 'status');
        });
    }
};
