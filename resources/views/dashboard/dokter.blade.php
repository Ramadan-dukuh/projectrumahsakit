<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter - Sistem Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    @extends('template')
     @section('content')

        <!-- Navigation -->
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-4">
                <div class="flex space-x-8">
                    <a href="{{ route('dokter.dashboard') }}" class="py-4 text-blue-600 border-b-2 border-blue-600 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('dokter.perawatan.list') }}" class="py-4 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-notes-medical mr-2"></i>Perawatan
                    </a>
                    <a href="#" class="py-4 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-calendar-check mr-2"></i>Jadwal
                    </a>
                    <a href="#" class="py-4 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-file-medical mr-2"></i>Rekam Medis
                    </a>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Dokter</h2>
            
            <!-- Welcome Section -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-4 rounded-full mr-4">
                        <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Selamat Datang, Dr. {{ $user->name }}!</h3>
                        <p class="text-gray-600">Ini adalah dashboard Anda untuk mengelola pasien dan perawatan.</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kunjungan Hari Ini</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $kunjunganHariIni }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-bed text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pasien Dirawat</p>
                            <h3 class="text-2xl font-bold text-gray-800">8</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Janji Temu Mendatang</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pasien</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keluhan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Ahmad Susanto</td>
                                <td class="px-6 py-4 whitespace-nowrap">10:00 - 10:30</td>
                                <td class="px-6 py-4">Demam dan batuk</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Siti Rahayu</td>
                                <td class="px-6 py-4 whitespace-nowrap">11:00 - 11:30</td>
                                <td class="px-6 py-4">Kontrol tekanan darah</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Budi Santoso</td>
                                <td class="px-6 py-4 whitespace-nowrap">13:30 - 14:00</td>
                                <td class="px-6 py-4">Pemeriksaan rutin</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('dokter.perawatan.list') }}" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-blue-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-notes-medical text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Lihat Perawatan</h3>
                    <p class="text-sm text-gray-600 mt-2">Kelola daftar perawatan pasien</p>
                </a>

                <a href="#" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-green-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-stethoscope text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Pemeriksaan</h3>
                    <p class="text-sm text-gray-600 mt-2">Lakukan pemeriksaan pasien</p>
                </a>

                <a href="#" class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="bg-purple-100 p-4 rounded-full inline-block mb-4">
                        <i class="fas fa-pills text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Resep Obat</h3>
                    <p class="text-sm text-gray-600 mt-2">Buat resep obat untuk pasien</p>
                </a>
            </div>
        </main>

       
    </div>
    @endsection
</body>
</html>