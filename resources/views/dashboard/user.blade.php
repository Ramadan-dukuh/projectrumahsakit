<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Sistem Rumah Sakit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            padding-top: 80px; /* To account for fixed header */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8fafc;
        }

        /* Header Styles - Updated to match landing page */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(220, 38, 38, 0.1);
            transition: all 0.3s ease;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            width: 100%;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #dc2626;
            text-decoration: none;
        }

        .logo::before {
            content: "⛑";
            margin-right: 8px;
            font-size: 1.8rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 1.5rem;
            margin-bottom: 0;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .nav-menu li a:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #dc2626;
        }

        /* Profile Dropdown Styles - Updated to match nav style */
        .profile-img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            vertical-align: middle;
        }
        
        .nav-item.dropdown {
            position: relative;
            list-style: none;
        }
        
        .profile-dropdown {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #4a5568;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
            border-radius: 6px;
            z-index: 1;
        }
        
        .dropdown-content a, .dropdown-content form {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: #4a5568;
            transition: all 0.3s ease;
        }
        
        .dropdown-content a:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: #4a5568;
            font-family: inherit;
            font-size: inherit;
            width: 100%;
            text-align: left;
            cursor: pointer;
            padding: 0;
        }
        
        .dropdown-content form:hover {
            background-color: #fef2f2;
        }
        
        .dropdown-content form:hover .logout-btn {
            color: #dc2626;
        }
        
        .nav-item.dropdown:hover .dropdown-content {
            display: block;
        }

        .nav-item.dropdown:hover .profile-dropdown {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Main Content */
        .container {
            flex: 1;
            padding-bottom: 2rem;
        }

        /* Dashboard specific styles */
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            background: #1f2937;
            color: white;
            padding: 3rem 5% 1rem;
            margin-top: auto;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #f9fafb;
            font-weight: 600;
        }

        .footer-section p, .footer-section a {
            color: #d1d5db;
            text-decoration: none;
            line-height: 1.8;
        }

        .footer-section a:hover {
            color: #fca5a5;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 1.5rem;
            text-align: center;
            color: #9ca3af;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                padding: 1rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }

            .nav-menu.active {
                display: flex;
            }

            .mobile-menu-btn {
                display: block;
            }

            .dropdown-content {
                position: static;
                box-shadow: none;
                margin-left: 1rem;
            }
        }
    </style>
</head>
<body>
    @extends('template')    
     @section('content')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8 dashboard-card">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard User</h2>
            
            <!-- Welcome Section -->
            <div class="bg-red-50 rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <div class="bg-red-100 p-4 rounded-full mr-4">
                        <i class="fas fa-user-injured text-red-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600">Ini adalah dashboard Anda untuk mengelola kunjungan dan informasi kesehatan.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow dashboard-card">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-calendar-plus text-green-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Request Kunjungan</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Ajukan kunjungan baru ke dokter untuk konsultasi atau perawatan.</p>
                    <a href="{{ route('kunjungan.create') }}" class="inline-flex items-center text-green-600 hover:text-green-700">
                        <span>Ajukan Sekarang</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow dashboard-card">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-history text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Kunjungan</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Lihat dan kelola semua riwayat kunjungan Anda ke rumah sakit.</p>
                    <a href="{{ route('kunjungan.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700">
                        <span>Lihat Riwayat</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Profil</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama Lengkap</p>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Role</p>
                        <p class="font-medium capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bergabung Pada</p>
                        <p class="font-medium">{{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        <i class="fas fa-edit mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </main>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle for the new navigation
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navMenu = document.querySelector('.nav-menu');
            
            if (mobileMenuBtn && navMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    navMenu.classList.toggle('active');
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdowns = document.querySelectorAll('.nav-item.dropdown');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        dropdown.querySelector('.dropdown-content').style.display = 'none';
                    }
                });
            });

            // Header background on scroll
            window.addEventListener('scroll', () => {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.style.boxShadow = '0 2px 20px rgba(220, 38, 38, 0.15)';
                } else {
                    header.style.boxShadow = '0 2px 10px rgba(220, 38, 38, 0.1)';
                }
            });
        });
    </script>
    @endsection
</body>
</html>