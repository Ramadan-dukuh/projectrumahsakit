@extends('template')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-person-badge me-2"></i>Detail Dokter</h3>
            <a href="{{ route('operator.dktr.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-3 text-center">
                    <div class="mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($dktr->namaDokter) }}&background=random&size=200" 
                             class="rounded-circle border border-3 border-primary" 
                             alt="Doctor Avatar"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <h4 class="text-primary">{{ $dktr->namaDokter }}</h4>
                    <span class="badge bg-primary fs-6">{{ $dktr->spesialisasi }}</span>
                </div>
                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="bi bi-person-vcard me-2"></i>Informasi Dokter</h5>
                                    <hr>
                                    <div class="mb-3">
                                        <strong class="d-block text-muted small">ID Dokter</strong>
                                        <span class="fs-5">{{ $dktr->idDokter }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="d-block text-muted small">Tanggal Lahir</strong>
                                        <span class="fs-5">{{ \Carbon\Carbon::parse($dktr->tanggalLahir)->format('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary"><i class="bi bi-geo-alt me-2"></i>Lokasi Praktik</h5>
                                    <hr>
                                    <div class="mb-3">
                                        <strong class="d-block text-muted small">Lokasi</strong>
                                        <span class="fs-5">{{ $dktr->lokasiPraktik }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="d-block text-muted small">Jam Praktik</strong>
                                        <span class="fs-5">{{ $dktr->jamPraktik }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('operator.dktr.edit', $dktr->id) }}" class="btn btn-warning me-2">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data
                </a>
                <form action="{{ route('operator.dktr.destroy', $dktr->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data dokter ini?')">
                        <i class="bi bi-trash me-1"></i> Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection