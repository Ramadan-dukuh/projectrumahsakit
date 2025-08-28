<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;

class KunjunganController extends Controller
{
    public function index() {
        $kunjungan = Kunjungan::where('user_id', Auth::id())->latest()->get();
        return view('kunjungan.index', compact('kunjungan'));
    }

    public function create() {
        return view('kunjungan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date|after_or_equal:today',
        ]);

        Kunjungan::create([
            'user_id' => Auth::id(),
            'keluhan' => $request->keluhan,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'status' => 'pending',
        ]);

        return redirect()->route('kunjungan.index')
                         ->with('success','Request kunjungan dikirim');
    }

    public function cancel($id) {
        $kunjungan = Kunjungan::where('id',$id)
                              ->where('user_id',Auth::id())
                              ->firstOrFail();
        if($kunjungan->status == 'pending') {
            $kunjungan->update(['status'=>'cancelled']);
        }
        return back()->with('success','Request dibatalkan');
    }
}
