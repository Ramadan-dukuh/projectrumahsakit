@extends('template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Ruangan</title>
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
        
        .alert {
            border-radius: 8px;
        }
        
        .badge-lokasi {
            background-color: #e3f2fd;
            color: #1565c0;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .ruangan-icon {
            width: 40px;
            height: 40px;
            background-color: #bbdefb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-building me-2"></i>Data Ruangan</h2>
                <a href="{{ route('operator.ruangan.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Ruangan
                </a>
            </div>
            
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Kode Ruangan</th>
                                <th width="20%">Nama Ruangan</th>
                                <th width="15%" class="text-center">Daya Tampung</th>
                                <th width="20%" class="text-center">Lokasi</th>
                                <th width="25%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($ruangan) > 0)
                                @foreach ($ruangan as $index => $r)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ruangan-icon">
                                                <i class="bi bi-door-closed text-primary"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-bold">{{ $r->kodeRuangan }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $r->namaRuangan }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary">{{ $r->dayaTampung }} orang</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-lokasi">{{ $r->lokasi }}</span>
                                    </td>
                                    <td class="text-center action-buttons">
                                        <a href="{{ route('operator.ruangan.show', $r->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('operator.ruangan.edit', $r->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('operator.ruangan.destroy', $r->id) }}" method="POST" style="display:inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit" title="Hapus" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="bi bi-inbox"></i>
                                            <h4>Belum ada data ruangan</h4>
                                            <p>Silakan tambah data ruangan dengan menekan tombol "Tambah Ruangan"</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Add tooltips to buttons
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>
@endsection