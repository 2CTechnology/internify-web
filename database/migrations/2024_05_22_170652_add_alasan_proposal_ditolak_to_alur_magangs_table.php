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
            $table->string('alasan_proposal_ditolak')->nullable()->after('revisi_proposal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alur_magangs', function (Blueprint $table) {
            //
        });
    }
};
