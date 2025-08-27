<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #dc2626;
            --secondary-color: #f8f9fa;
            --hover-color: #fef2f2;
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
            background-color: #b91c1c;
            border-color: #b91c1c;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
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
        
        .badge-spesialis {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    @extends('template')

    @section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="bi bi-heart-pulse me-2"></i>Data Dokter</h2>
                <a href="{{ route('dktr.create') }}" class="btn btn-light">
                    <i class="bi bi-plus-circle me-1"></i> Input Dokter
                </a>
            </div>
            
            <div class="card-body">
                @if ($message = Session::get('succes'))
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
                                <th width="15%">ID Dokter</th>
                                <th width="15%">Nama Dokter</th>
                                <th width="15%" class="text-center">Tanggal Lahir</th>
                                <th width="20%" class="text-center">Spesialisasi</th>
                                <th width="25%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dktr as $dokter)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $dokter->idDokter }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light me-3">
                                            <span class="symbol-label">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($dokter->namaDokter) }}&background=random" class="w-30px rounded-circle" alt="">
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-dark fw-bold">{{ $dokter->namaDokter }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($dokter->tanggalLahir)->format('d M Y') }}</td>
                                <td class="text-center">
                                    <span class="badge-spesialis">{{ $dokter->spesialisasi }}</span>
                                </td>
                                <td class="text-center action-buttons">
                                    <form action="{{ route('dktr.destroy', $dokter->id) }}" method="post" class="d-inline">
                                        <a href="{{ route('dktr.show', $dokter->id) }}" class="btn btn-sm btn-outline-primary" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('dktr.edit', $dokter->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" type="submit" title="Hapus" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">
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
                    {!! $dktr->links() !!}
                </div>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Add tooltips to buttons
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Format dates
            document.querySelectorAll('.date-cell').forEach(cell => {
                const date = new Date(cell.textContent);
                cell.textContent = date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            });
        });
    </script>
</body>
</html>