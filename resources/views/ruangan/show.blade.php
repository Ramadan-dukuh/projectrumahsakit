<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ruangan</title>
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
        
        .detail-card {
            transition: transform 0.2s;
        }
        
        .detail-card:hover {
            transform: translateY(-5px);
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: #bbdefb;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .detail-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #616161;
            min-width: 140px;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .action-buttons .btn {
            margin-right: 10px;
            min-width: 100px;
        }
    </style>
</head>

<body>
    @extends('template')

    @section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card detail-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0"><i class="bi bi-door-open me-2"></i>Detail Ruangan</h2>
                        <a href="{{ route('ruangan.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                    
                    <div class="card-body p-0">
                        <!-- Header Info -->
                        <div class="bg-light p-4 d-flex align-items-center">
                            <div class="info-icon">
                                <i class="bi bi-building text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h3 class="mb-1">{{ $ruangan->namaRuangan }}</h3>
                                <p class="text-muted mb-0">Kode: {{ $ruangan->kodeRuangan }} | Lokasi: {{ $ruangan->lokasi }}</p>
                            </div>
                        </div>
                        
                        <!-- Detail Information -->
                        <div class="p-4">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">ID Ruangan:</span>
                                        <span class="text-dark">{{ $ruangan->id }}</span>
                                    </div>
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">Kode Ruangan:</span>
                                        <span class="text-dark fw-bold">{{ $ruangan->kodeRuangan }}</span>
                                    </div>
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">Nama Ruangan:</span>
                                        <span class="text-dark">{{ $ruangan->namaRuangan }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">Daya Tampung:</span>
                                        <span class="text-dark">
                                            <span class="badge bg-primary rounded-pill">{{ $ruangan->dayaTampung }}</span> orang
                                        </span>
                                    </div>
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">Lokasi:</span>
                                        <span class="text-dark">{{ $ruangan->lokasi }}</span>
                                    </div>
                                    <div class="detail-item d-flex">
                                        <span class="detail-label">Status:</span>
                                        <span class="status-badge bg-success">Aktif</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Capacity Visualization -->
                            <div class="mt-4">
                                <h5 class="mb-3"><i class="bi bi-people me-2"></i>Visualisasi Kapasitas</h5>
                                <div class="progress mb-2" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ min(($ruangan->dayaTampung / 50) * 100, 100) }} % ;" 
                                         aria-valuenow="{{ $ruangan->dayaTampung }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="50">
                                        {{ $ruangan->dayaTampung }} orang
                                    </div>
                                </div>
                                <div class="form-text text-center">
                                    Kapasitas ruangan dibandingkan dengan standar maksimum (50 orang)
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center action-buttons">
                            <a href="{{ route('ruangan.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-list me-1"></i> Daftar Ruangan
                            </a>
                            <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Info Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informasi Tambahan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="bi bi-calendar me-2"></i>Riwayat</h6>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Dibuat pada
                                        <span class="text-muted">-</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Diperbarui pada
                                        <span class="text-muted">-</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="bi bi-grid me-2"></i>Fasilitas</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark">Proyektor</span>
                                    <span class="badge bg-light text-dark">AC</span>
                                    <span class="badge bg-light text-dark">Whiteboard</span>
                                    <span class="badge bg-light text-dark">Koneksi Internet</span>
                                </div>
                                
                                <h6 class="mt-3"><i class="bi bi-tag me-2"></i>Kategori</h6>
                                <span class="badge bg-info">Ruang Kelas</span>
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
            // Progress bar animation
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.transition = 'width 1s ease-in-out';
                }, 500);
            }
        });
    </script>
</body>
</html>