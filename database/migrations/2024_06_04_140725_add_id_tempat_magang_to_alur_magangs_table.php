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
            $table->unsignedBigInteger('id_tempat_magang')->nullable();
            $table->foreign('id_tempat_magang')
                ->references('id')
                ->on('tempat_magangs')
                ->onDelete('cascade')
                ->onDelete('cascade');
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
