@extends('template')

@section('content')
<div class="container">
    <h2>Detail Pasien</h2>

    <table class="table table-bordered">
        <tr>
            <th>No Rekam Medis</th>
            <td>{{ $pasien->nomorRekamMedis }}</td>
        </tr>
        <tr>
            <th>Nama Pasien</th>
            <td>{{ $pasien->namaPasien }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $pasien->tanggalLahir }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $pasien->jenisKelamin=='L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $pasien->alamatPasien }}</td>
        </tr>
        <tr>
            <th>Kota</th>
            <td>{{ $pasien->kotaPasien }}</td>
        </tr>
        <tr>
            <th>Usia</th>
            <td>{{ $pasien->usiaPasien }} tahun</td>
        </tr>
        <tr>
            <th>Penyakit</th>
            <td>{{ $pasien->penyakitPasien }}</td>
        </tr>
        <tr>
            <th>Dokter</th>
            <td>{{ $pasien->dokter->namaDokter ?? '-' }} ({{ $pasien->dokter->spesialisasi ?? '-' }})</td>
        </tr>
        <tr>
            <th>Tanggal Masuk</th>
            <td>{{ $pasien->tanggalMasuk }}</td>
        </tr>
        <tr>
            <th>Tanggal Keluar</th>
            <td>{{ $pasien->tanggalKeluar ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nomor Kamar</th>
            <td>{{ $pasien->ruangan->namaRuangan ?? '-' }}</td>
        </tr>
    </table>

    <a href="{{ route('pasiens.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('pasiens.edit', $pasien->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
