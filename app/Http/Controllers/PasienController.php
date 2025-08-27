<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    public function index() {
        $pasiens = Pasien::with(['dokter','ruangan'])->paginate(10);
        return view('pasiens.index', compact('pasiens'));
    }

    public function create() {
        $dokters = Dokter::select('idDokter','namaDokter','spesialisasi')->distinct()->get();
        $ruangans = Ruangan::where('dayaTampung', '>', 0)->get();
        return view('pasiens.create', compact('dokters','ruangans'));
    }

    public function store(Request $request) {
        $request->validate([
            'nomorRekamMedis' => [
                'required', 
                Rule::unique('pasiens')->where(function ($query) use ($request) {
                    return $query->where('nomorRekamMedis', $request->nomorRekamMedis);
                })
            ],
            'namaPasien' => 'required',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required',
            'alamatPasien' => 'required',
            'kotaPasien' => 'required',
            'penyakitPasien' => 'required',
            'idDokter' => 'required',
            'tanggalMasuk' => 'required|date',
            'nomorKamar' => 'required'
        ], [
            'nomorRekamMedis.unique' => 'Nomor Rekam Medis sudah terdaftar. Silakan gunakan nomor yang berbeda.'
        ]);

        $usia = date('Y') - date('Y', strtotime($request->tanggalLahir));

        $ruangan = Ruangan::where('kodeRuangan', $request->nomorKamar)->first();
        
        if(!$ruangan) {
            return back()->with('error', 'Kamar tidak ditemukan!')->withInput();
        }
        
        if($ruangan->dayaTampung <= 0) {
            return back()->with('error', 'Daya tampung kamar penuh! Silakan pilih kamar lain.')->withInput();
        }

        try {
            Pasien::create(array_merge($request->all(), ['usiaPasien' => $usia]));
            $ruangan->decrement('dayaTampung', 1);
            
            return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id) {
        $pasien = Pasien::with(['dokter','ruangan'])->findOrFail($id);
        return view('pasiens.show', compact('pasien'));
    }

    public function edit($id) {
        $pasien = Pasien::findOrFail($id);
        $dokters = Dokter::select('idDokter','namaDokter','spesialisasi')->distinct()->get();
        $ruangans = Ruangan::all();
        return view('pasiens.edit', compact('pasien','dokters','ruangans'));
    }

   public function update(Request $request, $id) {
    $pasien = Pasien::findOrFail($id);
    
    $request->validate([
        'nomorRekamMedis' => [
            'required', 
            Rule::unique('pasiens')->ignore($pasien->id)->where(function ($query) use ($request) {
                return $query->where('nomorRekamMedis', $request->nomorRekamMedis);
            })
        ],
        'namaPasien' => 'required',
        'tanggalLahir' => 'required|date',
        'jenisKelamin' => 'required',
        'alamatPasien' => 'required',
        'kotaPasien' => 'required',
        'penyakitPasien' => 'required',
        'idDokter' => 'required',
        'tanggalMasuk' => 'required|date',
        'nomorKamar' => 'required'
    ], [
        'nomorRekamMedis.unique' => 'Nomor Rekam Medis sudah terdaftar. Silakan gunakan nomor yang berbeda.'
    ]);

    // Jika pindah kamar, kembalikan kapasitas kamar lama dan kurangi kamar baru
    if ($pasien->nomorKamar != $request->nomorKamar) {
        $ruanganLama = Ruangan::where('kodeRuangan', $pasien->nomorKamar)->first();
        if ($ruanganLama) {
            $ruanganLama->increment('dayaTampung', 1);
        }
        
        $ruanganBaru = Ruangan::where('kodeRuangan', $request->nomorKamar)->first();
        if (!$ruanganBaru) {
            return back()->with('error', 'Kamar tidak ditemukan!')->withInput();
        }
        
        if ($ruanganBaru->dayaTampung <= 0) {
            // Kembalikan kapasitas kamar lama jika kamar baru penuh
            if ($ruanganLama) {
                $ruanganLama->decrement('dayaTampung', 1);
            }
            return back()->with('error', 'Daya tampung kamar baru penuh!')->withInput();
        }
        
        $ruanganBaru->decrement('dayaTampung', 1);
    }

    $usia = date('Y') - date('Y', strtotime($request->tanggalLahir));
    
    // Simpan nilai tanggalKeluar lama sebelum update
    $tanggalKeluarLama = $pasien->tanggalKeluar;

    // Update data pasien
    $pasien->update(array_merge($request->all(), ['usiaPasien' => $usia]));

    // Jika sebelumnya tanggalKeluar masih null dan sekarang diisi → kapasitas kamar bertambah
    if (is_null($tanggalKeluarLama) && $request->filled('tanggalKeluar')) {
        $ruangan = Ruangan::where('kodeRuangan', $pasien->nomorKamar)->first();
        if ($ruangan) {
            $ruangan->increment('dayaTampung', 1);
        }
    }
    
    return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil diupdate');
}


    public function destroy($id) {
        $pasien = Pasien::findOrFail($id);
        $ruangan = Ruangan::where('kodeRuangan', $pasien->nomorKamar)->first();
        
        if($ruangan) {
            $ruangan->increment('dayaTampung', 1);
        }
        
        $pasien->delete();
        
        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil dihapus');
    }

    // Tambahan method untuk menandai pasien keluar
    public function markAsLeft($id) {
        $pasien = Pasien::findOrFail($id);
        
        if ($pasien->status == 'pulang') {
            return redirect()->route('pasiens.index')->with('info', 'Pasien sudah ditandai sebagai pulang sebelumnya.');
        }
        
        $pasien->status = 'pulang';
        $pasien->tanggalKeluar = now();
        $pasien->save();
        
        $ruangan = Ruangan::where('kodeRuangan', $pasien->nomorKamar)->first();
        if($ruangan) {
            $ruangan->increment('dayaTampung', 1);
        }
        
        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil ditandai sebagai pulang dan kapasitas kamar dikembalikan.');
    }
}