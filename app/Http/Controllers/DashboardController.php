<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $jumlahDokter = Dokter::count();
        $jumlahPasien = Pasien::count();

        // Pie chart pasien per kamar
        $pasienPerKamar = Pasien::select('ruangan_id', DB::raw('count(*) as total'))
                            ->groupBy('ruangan_id')->with('ruangan')->get();

        // Bar chart penyakit pasien
        $penyakitChart = Pasien::select('penyakit', DB::raw('count(*) as total'))
                            ->groupBy('penyakit')->get();

        // Line chart pasien per gender
        $genderChart = Pasien::select('jenis_kelamin', DB::raw('count(*) as total'))
                            ->groupBy('jenis_kelamin')->get();

        return view('dashboard.index', compact('jumlahDokter','jumlahPasien','pasienPerKamar','penyakitChart','genderChart'));
    }
}
