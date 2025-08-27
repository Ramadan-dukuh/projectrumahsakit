@extends('template')

@section('content')
<div class="container">
    <h2>Edit Data Pasien</h2>

    <form action="{{ route('pasiens.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>No Rekam Medis</label>
            <input type="text" name="nomorRekamMedis" class="form-control" value="{{ $pasien->nomorRekamMedis }}" required readonly>
        </div>
        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="namaPasien" class="form-control" value="{{ $pasien->namaPasien }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggalLahir" class="form-control" value="{{ $pasien->tanggalLahir }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenisKelamin" class="form-control" required>
                <option value="L" {{ $pasien->jenisKelamin=='L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $pasien->jenisKelamin=='P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamatPasien" class="form-control" required>{{ $pasien->alamatPasien }}</textarea>
        </div>
        <div class="mb-3">
            <label>Kota</label>
            <input type="text" name="kotaPasien" class="form-control" value="{{ $pasien->kotaPasien }}" required>
        </div>
        <div class="mb-3">
            <label>Penyakit Pasien</label>
            <input type="text" name="penyakitPasien" class="form-control" value="{{ $pasien->penyakitPasien }}" required>
        </div>
        <div class="mb-3">
            <label>Dokter</label>
            <select name="idDokter" class="form-control" required>
                @foreach($dokters as $d)
                    <option value="{{ $d->idDokter }}" {{ $pasien->idDokter==$d->idDokter ? 'selected' : '' }}>
                        {{ $d->namaDokter }} - {{ $d->spesialisasi }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggalMasuk" class="form-control" value="{{ $pasien->tanggalMasuk }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Keluar</label>
            <input type="date" name="tanggalKeluar" class="form-control" value="{{ $pasien->tanggalKeluar }}">
        </div>
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <select name="nomorKamar" class="form-control" required>
                @foreach($ruangans as $r)
                    <option value="{{ $r->kodeRuangan }}" {{ $pasien->nomorKamar==$r->kodeRuangan ? 'selected' : '' }}>
                        {{ $r->namaRuangan }} (Sisa: {{ $r->dayaTampung }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pasiens.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
