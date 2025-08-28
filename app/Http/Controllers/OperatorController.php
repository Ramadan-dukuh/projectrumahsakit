<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Dokter;

class OperatorController extends Controller
{
    public function daftarKunjungan() {
        $kunjungan = Kunjungan::where('status','pending')->with('user')->get();
        return view('operator.kunjungan', compact('kunjungan'));
    }

    public function setDokter(Request $request, $id) {
        $kunjungan = Kunjungan::findOrFail($id);
        $pasien = Pasien::findOrFail($request->pasien_id);
        $pasien->dokter_id = $request->dokter_id;
        $pasien->save();
        $kunjungan->update(['status'=>'approved','pasien_id'=>$pasien->id]);
        return back()->with('success','Dokter ditetapkan untuk pasien');
    }
}
