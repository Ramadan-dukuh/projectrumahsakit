<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Kunjungan;

class DokterDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jumlahPasien = Pasien::where('idDokter', $user->id)->count();
        $kunjunganHariIni = Kunjungan::whereDate('created_at', today())->count();
        
        return view('dashboard.dokter', compact('user', 'jumlahPasien', 'kunjunganHariIni'));
    }
}