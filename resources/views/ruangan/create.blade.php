<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1e88e5;
            --secondary-color: #f8f9fa;
            --hover-color: #e3f2fd;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: none;
        }
        
        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1.2rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #1565c0;
            border-color: #1565c0;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(30, 136, 229, 0.25);
        }
        
        .form-section {
            margin-bottom: 1.5rem;
        }
        
        .icon-preview {
            width: 40px;
            height: 40px;
            background-color: #bbdefb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
    </style>
</head>

<body>
    @extends('template')

    @section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="bi bi-building me-2"></i>Tambah Ruangan Baru</h2>
                        <a href="{{ route('ruangan.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                    
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        <form action="{{ route('ruangan.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <h5 class="border-bottom pb-2 mb-3">Informasi Ruangan</h5>
                                        
                                        <div class="mb-3">
                                            <label for="kodeRuangan" class="form-label">Kode Ruangan</label>
                                            <input type="text" class="form-control" id="kodeRuangan" name="kodeRuangan" 
                                                value="{{ old('kodeRuangan') }}" required placeholder="Masukkan kode ruangan">
                                            <div class="form-text">Kode unik untuk identifikasi ruangan</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="namaRuangan" class="form-label">Nama Ruangan</label>
                                            <input type="text" class="form-control" id="namaRuangan" name="namaRuangan" 
                                                value="{{ old('namaRuangan') }}" required placeholder="Masukkan nama ruangan">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <h5 class="border-bottom pb-2 mb-3">Detail Kapasitas & Lokasi</h5>
                                        
                                        <div class="mb-3">
                                            <label for="dayaTampung" class="form-label">Daya Tampung</label>
                                            <input type="number" class="form-control" id="dayaTampung" name="dayaTampung" 
                                                value="{{ old('dayaTampung') }}" required min="1" placeholder="Jumlah orang">
                                            <div class="form-text">Jumlah maksimal orang yang dapat ditampung</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="lokasi" class="form-label">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" 
                                                value="{{ old('lokasi') }}" required placeholder="Contoh: Lantai 1, Gedung A">
                                            <div class="form-text">Lokasi atau posisi ruangan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section mt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-repeat me-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Preview Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-eye me-2"></i>Pratinjau Ruangan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="previewContent">
                                    <p class="text-muted">Data akan muncul setelah formulir diisi</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="icon-preview mx-auto">
                                    <i class="bi bi-door-closed text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to update preview
            function updatePreview() {
                const kode = document.getElementById('kodeRuangan').value || '[Kode Ruangan]';
                const nama = document.getElementById('namaRuangan').value || '[Nama Ruangan]';
                const dayaTampung = document.getElementById('dayaTampung').value || '[Daya Tampung]';
                const lokasi = document.getElementById('lokasi').value || '[Lokasi]';
                
                const previewHTML = `
                    <h5>${nama}</h5>
                    <p><strong>Kode:</strong> ${kode}</p>
                    <p><strong>Daya Tampung:</strong> ${dayaTampung} orang</p>
                    <p><strong>Lokasi:</strong> ${lokasi}</p>
                `;
                
                document.getElementById('previewContent').innerHTML = previewHTML;
            }
            
            // Add event listeners to all form inputs
            const formInputs = document.querySelectorAll('input');
            formInputs.forEach(input => {
                input.addEventListener('input', updatePreview);
            });
            
            // Initial update
            updatePreview();
        });
    </script>
</body>
</html>