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
    Schema::create('ruangan', function (Blueprint $table) {
        $table->id(); // auto increment
        $table->string('kodeRuangan');
        $table->string('namaRuangan');
        $table->integer('dayaTampung');
        $table->string('lokasi');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('ruangan');
}

};
