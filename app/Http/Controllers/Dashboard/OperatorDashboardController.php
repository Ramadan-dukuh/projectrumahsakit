<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class OperatorDashboardController extends Controller
{
    public function index()
    {
        $jumlahDokter = Dokter::count();
        $jumlahPasien = Pasien::count();
        
        // Pie chart pasien per kamar
        $pasienPerKamar = Pasien::select('nomorKamar', DB::raw('count(*) as total'))
                            ->groupBy('nomorKamar')->get();
        
        // Bar chart penyakit pasien
        $penyakitChart = Pasien::select('penyakitPasien as penyakit', DB::raw('count(*) as total'))
                            ->groupBy('penyakitPasien')->get();
        
        // Line chart pasien per gender
        $genderChart = Pasien::select('jenisKelamin', DB::raw('count(*) as total'))
                            ->groupBy('jenisKelamin')->get();
        
        return view('dashboard.operator', compact('jumlahDokter', 'jumlahPasien', 'pasienPerKamar', 'penyakitChart', 'genderChart'));
    }
}