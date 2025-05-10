<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('berita_acaras', function (Blueprint $table) {
        $table->bigIncrements('id'); // id utama, unsigned, auto_increment
        $table->unsignedBigInteger('tempat_magang_id')->index(); // foreign key bisa ditambahkan nanti jika perlu
        $table->date('jadwal');
        $table->string('prodi')->nullable();
        $table->string('jurusan')->nullable();
        $table->string('alamat')->nullable();
        $table->text('keterangan')->nullable();
        $table->text('catatan'); // tidak nullable
        $table->timestamps(); // created_at dan updated_at (nullable secara default)
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acaras');
    }
};
