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
    Schema::dropIfExists('faq');
}

public function down()
{
    Schema::create('faq', function (Blueprint $table) {
        $table->id();
        $table->string('pertanyaan');
        $table->string('jawaban');
        $table->timestamps();
    });
}

};
