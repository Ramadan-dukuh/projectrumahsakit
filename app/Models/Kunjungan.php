<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    protected $fillable = [
    'user_id',
    'pasien_id',
    'dokter_id',         // kalau Anda juga ingin dokter_id bisa diisi
    'status',
    'tanggal_kunjungan',
    'keluhan'
];


    public function user() {
        return $this->belongsTo(User::class);
    }
    public function pasien() {
        return $this->belongsTo(Pasien::class);
    }
}
