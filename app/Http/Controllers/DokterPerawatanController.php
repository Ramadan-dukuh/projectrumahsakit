<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPerawatan;

class DokterPerawatanController extends Controller
{
    public function create($pasienId) {
        return view('dokter.perawatan.create', compact('pasienId'));
    }

    public function store(Request $request) {
        RiwayatPerawatan::create($request->all());
        return redirect()->route('dokter.perawatan.list')->with('success','Perawatan tersimpan');
    }

    public function list() {
        $riwayat = RiwayatPerawatan::with('pasien','dokter')->get();
        return view('dokter.perawatan.list', compact('riwayat'));
    }
}
