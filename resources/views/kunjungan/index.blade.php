@extends('template')

@section('content')
<div class="container">
    <h1>Daftar Kunjungan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kunjungan.create') }}" class="btn btn-primary mb-3">Request Kunjungan Baru</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Dokter</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjungan as $k)
            <tr>
                <td>{{ $k->tanggal_kunjungan }}</td>
                <td>{{ $k->keluhan }}</td>
                <td>{{ ucfirst($k->status) }}</td>
                <td>{{ $k->dokter->nama ?? '-' }}</td>
                <td>
                    @if($k->status == 'pending')
                        <form method="POST" action="{{ route('kunjungan.cancel', $k->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Batalkan request ini?')">
                                Batalkan
                            </button>
                        </form>
                    @else
                        <span class="text-muted">Tidak bisa dibatalkan</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada request kunjungan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
