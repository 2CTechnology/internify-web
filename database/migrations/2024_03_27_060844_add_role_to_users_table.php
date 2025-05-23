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
        Schema::table('users', function (Blueprint $table) {
            $table->string('no_identitas', 30)->nullable()->after('name');
            $table->enum('role', ['Admin', 'Mahasiswa', 'Dosen', 'Prodi'])->after('remember_token');
            $table->boolean('is_accepted')->nullable();
            $table->string('angkatan', 4)->nullable();
            $table->string('golongan', 15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
