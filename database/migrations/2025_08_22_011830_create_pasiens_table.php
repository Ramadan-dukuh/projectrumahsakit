<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nomorRekamMedis')->unique();
            $table->string('namaPasien');
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->text('alamatPasien');
            $table->string('kotaPasien');
            $table->integer('usiaPasien');
            $table->string('penyakitPasien');
            $table->string('idDokter'); // relasi ke tabel dokters
            $table->date('tanggalMasuk');
            $table->date('tanggalKeluar')->nullable();
            $table->string('nomorKamar'); // relasi ke tabel ruangan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
