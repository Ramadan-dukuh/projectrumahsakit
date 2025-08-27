@extends('template')

@section('content')
<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0"><i class="bi bi-person-plus me-2"></i>Tambah Dokter Baru</h3>
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

            <form action="{{ route('dktr.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="idDokter" class="form-control" id="idDokter" 
                                   placeholder="ID Dokter" value="{{ old('idDokter') }}"
                                   required>
                            <label for="idDokter">ID Dokter</label>
                            <small class="text-muted">Contoh: DKT-001</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="text" name="namaDokter" class="form-control" id="namaDokter" 
                                   placeholder="Nama Dokter" value="{{ old('namaDokter') }}"
                                   required>
                            <label for="namaDokter">Nama Lengkap Dokter</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" 
                                   value="{{ old('tanggalLahir') }}" required>
                            <label for="tanggalLahir">Tanggal Lahir</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <select name="spesialisasi" class="form-select" id="spesialisasi" required>
                                <option value="" selected disabled>Pilih Spesialisasi</option>
                                <option value="Poli Umum" {{ old('spesialisasi') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                                <option value="Poli Anak" {{ old('spesialisasi') == 'Poli Anak' ? 'selected' : '' }}>Poli Anak</option>
                                <option value="Poli Gigi" {{ old('spesialisasi') == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi</option>
                                <option value="Poli Mata" {{ old('spesialisasi') == 'Poli Mata' ? 'selected' : '' }}>Poli Mata</option>
                                <option value="Poli Kulit" {{ old('spesialisasi') == 'Poli Kulit' ? 'selected' : '' }}>Poli Kulit</option>
                                <option value="Poli Penyakit Dalam" {{ old('spesialisasi') == 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                                <option value="Poli Konseling" {{ old('spesialisasi') == 'Poli Konseling' ? 'selected' : '' }}>Poli Konseling</option>
                                <option value="Poli Saraf" {{ old('spesialisasi') == 'Poli Saraf' ? 'selected' : '' }}>Poli Saraf</option>
                                <option value="Poli THT" {{ old('spesialisasi') == 'Poli THT' ? 'selected' : '' }}>Poli THT</option>
                                <option value="Poli Bedah" {{ old('spesialisasi') == 'Poli Bedah' ? 'selected' : '' }}>Poli Bedah</option>
                                <option value="Poli Paru" {{ old('spesialisasi') == 'Poli Paru' ? 'selected' : '' }}>Poli Paru</option>
                                <option value="Poli Jantung" {{ old('spesialisasi') == 'Poli Jantung' ? 'selected' : '' }}>Poli Jantung</option>
                                <option value="Poli Gizi Klinik" {{ old('spesialisasi') == 'Poli Gizi Klinik' ? 'selected' : '' }}>Poli Gizi Klinik</option>
                            </select>
                            <label for="spesialisasi">Spesialisasi</label>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
    <div class="form-floating">
        <select name="lokasiPraktik" class="form-select" id="lokasiPraktik" required>
            <option value="" disabled selected>Pilih Ruangan</option>
            @foreach($ruangan as $r)
                <option value="{{ $r->namaRuangan }}" 
                    {{ old('lokasiPraktik') == $r->namaRuangan ? 'selected' : '' }}>
                    {{ $r->namaRuangan }}
                </option>
            @endforeach
        </select>
        <label for="lokasiPraktik">Nama Ruangan</label>
    </div>
</div>

                    
                    <div class="col-md-6 mb-3">
                        <div class="form-floating">
                            <input type="time" name="jamPraktik" class="form-control" id="jamPraktik" 
                                   value="{{ old('jamPraktik') }}" required>
                            <label for="jamPraktik">Jam Praktik</label>
                            <small class="text-muted">Contoh: 08:00 - 16:00</small>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection