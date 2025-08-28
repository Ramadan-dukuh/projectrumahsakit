@extends('template')

@section('content')
<div class="container">
    <h1>Request Kunjungan Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('kunjungan.store') }}">
        @csrf
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan Penyakit</label>
            <textarea name="keluhan" id="keluhan" class="form-control" required>{{ old('keluhan') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control"
                   value="{{ old('tanggal_kunjungan') }}" required>
        </div>
        <button type="submit" class="btn btn-success">Kirim Request</button>
        <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
