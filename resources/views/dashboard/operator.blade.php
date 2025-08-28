<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operator - Sistem Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @extends('template')    
     @section('content')
    <div class="min-h-screen flex flex-col">       

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Operator</h2>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-user-md text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jumlah Dokter</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $jumlahDokter }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-user-injured text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jumlah Pasien</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $jumlahPasien }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-bed text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Ruangan</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $pasienPerKamar->sum('total') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-check text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kunjungan Hari Ini</p>
                            <h3 class="text-2xl font-bold text-gray-800">15</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Pie Chart - Pasien per Kamar -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Pasien per Kamar</h3>
                    <div class="h-64">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>

                <!-- Bar Chart - Penyakit Pasien -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Jumlah Pasien per Penyakit</h3>
                    <div class="h-64">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart - Pasien per Gender -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Trend Pasien berdasarkan Jenis Kelamin</h3>
                <div class="h-64">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('operator.pasiens.create') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-blue-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-plus-circle text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Tambah Pasien</h3>
                </a>

                <a href="{{ route('operator.dktr.create') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-green-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-user-plus text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Tambah Dokter</h3>
                </a>

                <a href="{{ route('operator.ruangan.create') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-purple-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-bed text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Tambah Ruangan</h3>
                </a>

                <a href="{{ route('operator.kunjungan') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-yellow-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-tasks text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Kelola Kunjungan</h3>
                </a>
            </div>
        </main>
      
       
    </div>

    <script>
        // Pie Chart - Pasien per Kamar
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($pasienPerKamar->pluck('nomorKamar')) !!},
                datasets: [{
                    data: {!! json_encode($pasienPerKamar->pluck('total')) !!},
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', 
                        '#EF4444', '#EC4899', '#6EE7B7', '#6366F1'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Bar Chart - Penyakit Pasien
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($penyakitChart->pluck('penyakit')) !!},
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: {!! json_encode($penyakitChart->pluck('total')) !!},
                    backgroundColor: '#3B82F6',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Line Chart - Pasien per Gender
     // Ambil data gender dari controller
const genderLabels = {!! json_encode($genderChart->pluck('jenisKelamin')) !!};
const genderData = {!! json_encode($genderChart->pluck('total')) !!};

const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: genderLabels,
        datasets: [{
            label: 'Jumlah Pasien',
            data: genderData,
            borderColor: '#3B82F6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { beginAtZero: true }
        }
    }
});


    </script>
      @endsection
</body>
</html>