<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS Sehat Prima - Pelayanan Kesehatan Terpercaya</title>
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
        }

        /* Header */
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
            max-width: 1200px;
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

        .login-btn {
            background: #dc2626 !important;
            color: white !important;
            padding: 0.6rem 1.5rem !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: #b91c1c !important;
            transform: translateY(-1px);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #dc2626;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            padding: 0 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            font-weight: 300;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 1rem 2rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .cta-primary {
            background: white;
            color: #dc2626;
        }

        .cta-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.5);
        }

        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .cta-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
        }

        /* Services Section */
        .services {
            padding: 5rem 5%;
            background: #f9fafb;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .service-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.1);
            border-color: #fecaca;
        }

        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #dc2626;
        }

        .service-card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .service-card p {
            color: #6b7280;
            line-height: 1.6;
        }

        /* About Section */
        .about {
            padding: 5rem 5%;
            background: white;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .about-content p {
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .features-list {
            list-style: none;
        }

        .features-list li {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #374151;
        }

        .features-list li::before {
            content: "✓";
            color: #dc2626;
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .about-image {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .about-image img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        /* Stats Section */
        .stats {
            padding: 4rem 5%;
            background: #dc2626;
            color: white;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            opacity: 0.9;
            font-weight: 300;
        }

        /* Footer */
        footer {
            background: #1f2937;
            color: white;
            padding: 3rem 5% 1rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
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

        /* Responsive Design */
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

            .hero h1 {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .about-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        /* Smooth animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="#" class="logo">RS Sehat Prima</a>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#igd">IGD</a></li>
                <li><a href="{{ route('dktr.index') }}">Dokter</a></li>
                <li><a href="#pasien">Pasien</a></li>
                <li><a href="#ruang-rawat">Ruang Rawat</a></li>
                <li><a href="#pendaftaran">Pendaftaran</a></li>
                <li><a href="{{ route('login') }}" class="login-btn">Login</a></li>
            </ul>
            <button class="mobile-menu-btn">☰</button>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Kesehatan Terbaik untuk Keluarga Anda</h1>
            <p>Pelayanan medis berkualitas tinggi dengan teknologi modern dan tim dokter berpengalaman</p>
            <div class="cta-buttons">
                <a href="#pendaftaran" class="cta-btn cta-primary">Daftar Online</a>
                <a href="#igd" class="cta-btn cta-secondary">IGD 24 Jam</a>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>15+</h3>
                <p>Tahun Pengalaman</p>
            </div>
            <div class="stat-item">
                <h3>25+</h3>
                <p>Dokter Spesialis</p>
            </div>
            <div class="stat-item">
                <h3>10k+</h3>
                <p>Pasien Terlayani</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Layanan IGD</p>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2 class="section-title fade-in">Layanan Kami</h2>
            <p class="section-subtitle fade-in">Kami menyediakan berbagai layanan kesehatan komprehensif untuk memenuhi kebutuhan medis Anda</p>
            
            <div class="services-grid">
                <div class="service-card fade-in">
                    <div class="service-icon">🚑</div>
                    <h3>Instalasi Gawat Darurat</h3>
                    <p>Pelayanan emergency 24 jam dengan tim medis siaga dan peralatan canggih untuk penanganan kasus darurat.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">👨‍⚕️</div>
                    <h3>Dokter Spesialis</h3>
                    <p>Tim dokter spesialis berpengalaman dalam berbagai bidang kedokteran untuk perawatan optimal.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">🏥</div>
                    <h3>Ruang Rawat Inap</h3>
                    <p>Fasilitas rawat inap nyaman dengan berbagai kelas sesuai kebutuhan dan budget Anda.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">🧪</div>
                    <h3>Laboratorium</h3>
                    <p>Laboratorium modern dengan peralatan canggih untuk pemeriksaan yang akurat dan cepat.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">💊</div>
                    <h3>Apotek</h3>
                    <p>Apotek lengkap dengan obat-obatan berkualitas dan konsultasi farmasi profesional.</p>
                </div>
                
                <div class="service-card fade-in">
                    <div class="service-icon">🩺</div>
                    <h3>Medical Check-up</h3>
                    <p>Paket pemeriksaan kesehatan menyeluruh untuk deteksi dini berbagai penyakit.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="about-container">
            <div class="about-content fade-in">
                <h2>RS Sehat Prima</h2>
                <p>Rumah sakit terpercaya dengan komitmen memberikan pelayanan kesehatan terbaik untuk masyarakat. Didukung oleh teknologi modern dan tenaga medis profesional yang berpengalaman.</p>
                
                <ul class="features-list">
                    <li>Terakreditasi KARS Paripurna</li>
                    <li>Peralatan Medis Berstandar Internasional</li>
                    <li>Tim Medis Berpengalaman & Profesional</li>
                    <li>Pelayanan 24 Jam Setiap Hari</li>
                    <li>Fasilitas Lengkap & Modern</li>
                </ul>
            </div>
            
            <div class="about-image fade-in">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 350'%3E%3Cdefs%3E%3ClinearGradient id='bg' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%23dc2626'/%3E%3Cstop offset='100%25' style='stop-color:%23991b1b'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='600' height='350' fill='url(%23bg)'/%3E%3Cg fill='white' opacity='0.9'%3E%3Crect x='150' y='80' width='300' height='190' rx='15'/%3E%3Crect x='170' y='60' width='260' height='30' rx='15'/%3E%3Ccircle cx='220' cy='140' r='25'/%3E%3Ccircle cx='380' cy='140' r='25'/%3E%3Crect x='180' y='190' width='240' height='12' rx='6'/%3E%3Crect x='180' y='215' width='180' height='12' rx='6'/%3E%3Crect x='180' y='240' width='200' height='12' rx='6'/%3E%3C/g%3E%3Ctext x='300' y='320' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='20' font-weight='bold'%3ERS Sehat Prima%3C/text%3E%3C/svg%3E" alt="RS Sehat Prima">
            </div>
        </div>
    </section>

    <footer>
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
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');

        mobileMenuBtn.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    navMenu.classList.remove('active');
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

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Counter animation for stats
        const animateCounter = (element, target) => {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                if (target > 1000) {
                    element.textContent = Math.floor(current / 1000) + 'k+';
                } else {
                    element.textContent = Math.floor(current) + '+';
                }
            }, 30);
        };

        // Animate stats when they come into view
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statItems = entry.target.querySelectorAll('.stat-item h3');
                    const targets = [15, 25, 10000, 24];
                    statItems.forEach((item, index) => {
                        animateCounter(item, targets[index]);
                    });
                    statsObserver.unobserve(entry.target);
                }
            });
        });

        const statsSection = document.querySelector('.stats');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    </script>
</body>
</html>