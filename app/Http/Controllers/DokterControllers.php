<?php

namespace App\Http\Controllers;
use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DokterControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dktr = Dokter::latest()->paginate(5);
        return view('dktr.index',compact('dktr'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $ruangan = Ruangan::all(); // ambil semua data ruangan
    return view('dktr.create', compact('ruangan'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'idDokter' => 'required|unique:dokters,idDokter',
                'namaDokter' => 'required',
                'tanggalLahir' => 'required',
                'spesialisasi' => 'required',
                'lokasiPraktik' => 'required',
                'jamPraktik' => 'required',
            ]
            );
        Dokter::create($request->all());
        return redirect()->route('operator.dktr.index')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dktr)
    {
        //
        return view('dktr.show',compact('dktr'));
    }
    public function landing(Dokter $dktr)
    {
        //
        return view('dktr.landing',compact('dktr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dktr)
{
    $ruangan = Ruangan::all(); // ambil semua data ruangan
    return view('dktr.edit', compact('dktr', 'ruangan'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dktr)
    {
        //
        $request->validate(
            [
                'idDokter' => 'required|unique:dokters,idDokter,'. $dktr->id,
                'namaDokter' => 'required',
                'tanggalLahir' => 'required',
                'spesialisasi' => 'required',
                'lokasiPraktik' => 'required',
                'jamPraktik' => 'required',
            ]
            );
            $dktr->update($request->all());
            return redirect()->route('operator.dktr.index')->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Dokter $dktr)
    {
        //
        $dktr->delete();
        return redirect()->route('dktr.index')->with('success','Data Berhasil Dihapus');
    }
}
