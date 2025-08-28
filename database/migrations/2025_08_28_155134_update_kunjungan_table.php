<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->foreignId('dokter_id')->nullable()
                  ->constrained('dokters')
                  ->onDelete('set null');
            $table->date('tanggal_kunjungan')->nullable();
            $table->text('keluhan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('kunjungan', function (Blueprint $table) {
            $table->dropForeign(['dokter_id']);
            $table->dropColumn(['dokter_id', 'tanggal_kunjungan', 'keluhan']);
        });
    }
};
