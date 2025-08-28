@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Pasien</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('operator.pasiens.store') }}" method="POST" id="pasienForm">
        @csrf
        <div class="mb-3">
            <label>No Rekam Medis</label>
            <input type="text" name="nomorRekamMedis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="namaPasien" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggalLahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenisKelamin" class="form-control" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamatPasien" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Kota</label>
            <input type="text" name="kotaPasien" class="form-control" required>
        </div>

        {{-- Step 1: Pilih Penyakit --}}
        <div class="mb-3">
            <label>Penyakit Pasien</label>
            <select name="penyakitPasien" id="penyakitPasien" class="form-control" required onchange="filterDokter()">
                <option value="">Pilih Penyakit</option>
                @php 
                    $spesialisasiList = $dokters->pluck('spesialisasi')->unique();
                @endphp
                @foreach($spesialisasiList as $spesialis)
                    @php 
                        $spesialisBersih = trim(str_replace('Poli', '', $spesialis));
                    @endphp
                    <option value="{{ $spesialisBersih }}">{{ $spesialisBersih }}</option>
                @endforeach
            </select>
        </div>

        {{-- Step 2: Pilih Dokter berdasarkan penyakit --}}
        <div class="mb-3">
            <label>Dokter</label>
            <select name="idDokter" id="idDokter" class="form-control" required>
                <option value="">Pilih Dokter</option>
                @foreach($dokters as $d)
                    @php 
                        $spesialisBersih = trim(str_replace('Poli', '', $d->spesialisasi));
                    @endphp
                    <option value="{{ $d->idDokter }}" data-spesialisasi="{{ $spesialisBersih }}">
                        {{ $d->namaDokter }} - {{ $spesialisBersih }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggalMasuk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nomor Kamar</label>
            <select name="nomorKamar" class="form-control" required>
                @foreach($ruangans as $r)
                    <option value="{{ $r->kodeRuangan }}">{{ $r->namaRuangan }} (Sisa: {{ $r->dayaTampung }})</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('operator.pasiens.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
function filterDokter() {
    const penyakitSelect = document.getElementById('penyakitPasien');
    const selectedPenyakit = penyakitSelect.value.trim();

    const dokterSelect = document.getElementById('idDokter');
    const options = dokterSelect.options;

    for (let i = 0; i < options.length; i++) {
        const spesialis = (options[i].getAttribute('data-spesialisasi') || '').trim();
        if (options[i].value === "") {
            options[i].style.display = "";
        } else if (spesialis === selectedPenyakit || selectedPenyakit === "") {
            options[i].style.display = "";
        } else {
            options[i].style.display = "none";
        }
    }

    // Reset pilihan dokter saat penyakit berubah
    dokterSelect.value = "";
}

// Panggil fungsi saat halaman dimuat untuk memastikan filter konsisten
document.addEventListener('DOMContentLoaded', filterDokter);
</script>
@endsection
