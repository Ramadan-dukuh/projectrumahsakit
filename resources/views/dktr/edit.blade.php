@extends('template')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Data Dokter</h3>
            <a href="{{ route('dktr.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
        
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Input gagal!</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{ route('dktr.update', $dktr->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="idDokter" class="form-control" id="idDokter" 
                                   placeholder="ID Dokter" value="{{ old('idDokter', $dktr->idDokter) }}"
                                   required>
                            <label for="idDokter">ID Dokter</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="namaDokter" class="form-control" id="namaDokter" 
                                   placeholder="Nama Dokter" value="{{ old('namaDokter', $dktr->namaDokter) }}"
                                   required>
                            <label for="namaDokter">Nama Dokter</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" 
                                   value="{{ old('tanggalLahir', $dktr->tanggalLahir) }}" required>
                            <label for="tanggalLahir">Tanggal Lahir</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="spesialisasi" class="form-control" id="spesialisasi" 
                                   placeholder="Spesialisasi" value="{{ old('spesialisasi', $dktr->spesialisasi) }}"
                                   required>
                            <label for="spesialisasi">Spesialisasi</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="time" name="jamPraktik" class="form-control" id="jamPraktik" 
                                   value="{{ old('jamPraktik', $dktr->jamPraktik) }}" required>
                            <label for="jamPraktik">Jam Praktik</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
    <div class="form-floating">
        <select name="lokasiPraktik" class="form-select" id="lokasiPraktik" required>
            <option value="" disabled>Pilih Ruangan</option>
            @foreach($ruangan as $r)
                <option value="{{ $r->namaRuangan }}" 
                    {{ $dktr->lokasiPraktik == $r->namaRuangan ? 'selected' : '' }}>
                    {{ $r->namaRuangan }}
                </option>
            @endforeach
        </select>
        <label for="lokasiPraktik">Nama Ruangan</label>
    </div>
</div>

                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection