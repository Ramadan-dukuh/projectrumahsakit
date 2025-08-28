<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerawatan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_perawatan';
    protected $fillable = ['pasien_id','dokter_id','penyakit','obat','dosis','tanggal_masuk','tanggal_keluar'];

    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }
    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
}
