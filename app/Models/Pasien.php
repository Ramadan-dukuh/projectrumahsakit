<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomorRekamMedis','namaPasien','tanggalLahir','jenisKelamin',
        'alamatPasien','kotaPasien','usiaPasien','penyakitPasien',
        'idDokter','tanggalMasuk','tanggalKeluar','nomorKamar'
    ];

    public function dokter() {
        return $this->belongsTo(Dokter::class, 'idDokter', 'idDokter');
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class, 'nomorKamar', 'kodeRuangan');
    }
}
