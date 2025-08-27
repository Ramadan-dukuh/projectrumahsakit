@extends('template')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien - Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .table {
            margin-bottom: 0;            
        }
        
        .table th {
            background-color: #f1f1f1;
            font-weight: 600;
        }
        
        .table-hover tbody tr:hover {
            background-color: var(--hover-color);
        }
        
        .action-buttons .btn {
            margin-right: 5px;
            min-width: 70px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination .page-link {
            color: var(--primary-color);
        }
        
        .alert {
            border-radius: 8px;
        }
        
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .status-rawat {
            background-color: #fff8e1;
            color: #f57c00;
        }
        
        .status-pulang {
            background-color: #e8f5e9;
            color: #388e3c;
        }
        
        .avatar-container {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e3f2fd;
            color: var(--primary-color);
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-people-fill me-2"></i>Data Pasien</h2>
                <a href="{{ route('pasiens.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pasien
                </a>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="10%">No RM</th>
                                <th width="20%">Nama Pasien</th>
                                <th width="10%" class="text-center">Usia</th>
                                <th width="15%">Dokter</th>
                                <th width="15%">Kamar</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pasiens as $index => $p)
                            <tr>
                                <td class="text-center">{{ ($pasiens->currentPage() - 1) * $pasiens->perPage() + $loop->iteration }}</td>
                                <td>{{ $p->nomorRekamMedis }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-container">
                                            {{ substr($p->namaPasien, 0, 1) }}
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold">{{ $p->namaPasien }}</span>
                                            <small class="text-muted">Terdaftar: {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $p->usiaPasien }} thn</td>
                                <td>
                                    @if($p->dokter)
                                        <span class="badge bg-light text-dark">{{ $p->dokter->namaDokter ?? '-' }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->ruangan)
                                        <span class="badge bg-info text-dark">{{ $p->ruangan->namaRuangan ?? '-' }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center action-buttons">
                                    <a href="{{ route('pasiens.show', $p->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pasiens.edit', $p->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pasiens.destroy', $p->id) }}" method="POST" style="display:inline-block">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $pasiens->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add tooltips to buttons
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>
@endsection