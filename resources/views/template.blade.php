<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Data Dokter</title>
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
    <header>
        <nav>
            <a href="{{ route('dktr.landing') }}" class="logo">RS Sehat Prima</a>
            <button class="mobile-menu-btn">☰</button>
            <ul class="nav-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('dktr.landing') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#igd">IGD</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('dktr.index') }}">Dokter</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('pasiens.index') }}">Pasien</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ruangan.index') }}">Ruang Rawat</a></li>
                <li class="nav-item"><a class="nav-link" href="#pendaftaran">Pendaftaran</a></li>
                <li class="nav-item dropdown">
                    <a class="profile-dropdown" href="#">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="profile-img me-1">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" class="profile-img me-1">
                        @endif
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-content">
                        <a href="{{ route('profile.edit') }}">Profil Saya</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>
    
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>RS Sehat Prima</h3>
                    <p>Jl. Sehat Sejahtera No. 123<br>
                    Jakarta Selatan 12345<br>
                    Telp: (021) 123-4567<br>
                    Email: info@rssehatprima.com</p>
                </div>
                
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <p>
                        <a href="#igd">IGD 24 Jam</a><br>
                        <a href="#dokter">Poliklinik Spesialis</a><br>
                        <a href="#ruang-rawat">Rawat Inap</a><br>
                        <a href="#pendaftaran">Pendaftaran Online</a>
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>Informasi</h3>
                    <p>
                        <a href="#">Jadwal Dokter</a><br>
                        <a href="#">Tarif Pelayanan</a><br>
                        <a href="#">Fasilitas</a><br>
                        <a href="#">Cara Pendaftaran</a>
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>Jam Operasional</h3>
                    <p>
                        IGD: 24 Jam<br>
                        Poliklinik: 08.00 - 20.00<br>
                        Administrasi: 07.00 - 21.00<br>
                        Farmasi: 06.00 - 22.00
                    </p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 RS Sehat Prima. Semua hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

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
</body>
</html>