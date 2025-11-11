<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spectare - Pesan Tiket Bioskop Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-red: #ef4444;
            --dark-bg: #0a0a0a;
            --card-bg: #1a1a1a;
            --border-color: #333333;
            --text-light: #ffffff;
            --text-gray: #d1d5db;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-light);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        @keyframes float-reverse {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-40px, 40px); }
        }

        @keyframes spin-reel {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.3); }
            50% { box-shadow: 0 0 40px rgba(239, 68, 68, 0.6); }
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        @keyframes float-item {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* ===== UTILITIES ===== */
        .animate-float {
            animation: float 20s ease-in-out infinite;
        }

        .animate-float-reverse {
            animation: float-reverse 25s ease-in-out infinite;
        }

        .animate-spin-reel {
            animation: spin-reel 4s linear infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .animate-slide-in {
            animation: slide-in 0.6s ease-out;
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out;
        }

        .animate-float-item {
            animation: float-item 3s ease-in-out infinite;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-content {
            max-width: 7xl;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-red);
            letter-spacing: 0.1em;
        }

        .nav-links {
            display: none;
            gap: 2rem;
            font-weight: 500;
            color: var(--text-gray);
        }

        .nav-links a {
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-red);
        }

        @media (min-width: 768px) {
            .nav-links {
                display: flex;
            }
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .cart-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .cart-btn:hover {
            transform: scale(1.1);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-red);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .auth-btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-login {
            background-color: var(--primary-red);
            color: white;
        }

        .btn-login:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
        }

        .btn-register {
            background-color: transparent;
            color: white;
            border: 2px solid var(--border-color);
        }

        .btn-register:hover {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            padding: 6rem 1rem 4rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.8) 0%, rgba(26, 26, 26, 0.9) 100%);
            border-bottom: 1px solid var(--border-color);
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.05) 0%, transparent 70%);
            animation: float-reverse 25s ease-in-out infinite;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 3xl;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            animation: fade-in-down 0.8s ease-out;
        }

        .hero-title span {
            color: var(--primary-red);
        }

        .hero-subtitle {
            font-size: 1.125rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.6;
            animation: fade-in-down 1s ease-out;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: slide-in 1.2s ease-out;
        }

        .btn-primary {
            padding: 0.875rem 2rem;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.4);
        }

        .btn-secondary {
            padding: 0.875rem 2rem;
            background-color: transparent;
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--primary-red);
            color: white;
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.4);
        }

        @media (max-width: 640px) {
            .hero-title {
                font-size: 1.875rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .hero-buttons button {
                width: 100%;
            }
        }

        /* ===== GENRE FILTER ===== */
        .genre-section {
            padding: 3rem 1rem;
            max-width: 7xl;
            margin: 0 auto;
        }

        .section-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .section-title span {
            color: var(--primary-red);
        }

        .genre-filter {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            padding-bottom: 1rem;
            scroll-behavior: smooth;
        }

        .genre-btn {
            padding: 0.625rem 1.5rem;
            border: 2px solid var(--border-color);
            background-color: transparent;
            color: var(--text-light);
            border-radius: 2rem;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .genre-btn:hover,
        .genre-btn.active {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
        }

        /* ===== MOVIES CAROUSEL ===== */
        .movies-section {
            padding: 3rem 1rem;
            max-width: 7xl;
            margin: 0 auto;
        }

        .carousel-container {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 1rem;
        }

        .carousel-item {
            flex: 0 0 200px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            group;
        }

        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .carousel-item:hover img {
            border-color: var(--primary-red);
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.4);
        }

        .carousel-item-title {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            text-align: center;
            font-weight: 600;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        /* ===== LOCATIONS SECTION ===== */
        .locations-section {
            padding: 3rem 1rem;
            background-color: rgba(10, 10, 10, 0.6);
            max-width: 7xl;
            margin: 0 auto;
        }

        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .location-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .location-card:hover {
            border-color: var(--primary-red);
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.2);
        }

        .location-card h3 {
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .location-card p {
            color: var(--text-gray);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .location-card button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .location-card button:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }

        /* ===== FOOD SECTION ===== */
        .food-section {
            padding: 3rem 1rem;
            max-width: 7xl;
            margin: 0 auto;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .food-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .food-card:hover {
            border-color: var(--primary-red);
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(239, 68, 68, 0.2);
        }

        .food-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .food-card-content {
            padding: 1.25rem;
        }

        .food-card h3 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .food-card p {
            color: var(--text-gray);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .food-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .food-price {
            color: var(--primary-red);
            font-weight: 700;
            font-size: 1.125rem;
        }

        .add-to-cart-btn {
            background-color: var(--primary-red);
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #dc2626;
            transform: scale(1.05);
        }

        /* ===== MODAL ===== */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.3s ease;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background-color: var(--card-bg);
            border: 2px solid var(--primary-red);
            border-radius: 0.75rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .close-btn {
            background: none;
            border: none;
            color: var(--text-light);
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: var(--primary-red);
        }

        .modal-content > div {
            padding: 1.5rem;
        }

        .modal-label {
            color: var(--text-gray);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .time-slots {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .time-slot {
            background-color: rgba(51, 51, 51, 0.5);
            border: 1px solid var(--border-color);
            padding: 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .time-slot:hover,
        .time-slot.selected {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
        }

        /* ===== CART SIDEBAR ===== */
        .cart-sidebar {
            position: fixed;
            right: 0;
            top: 0;
            height: 100%;
            width: 320px;
            background-color: var(--card-bg);
            border-left: 1px solid var(--border-color);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 45;
            overflow-y: auto;
        }

        .cart-sidebar.active {
            transform: translateX(0);
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .cart-items {
            padding: 1.5rem;
        }

        .cart-item {
            background-color: rgba(51, 51, 51, 0.5);
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item-info p:first-child {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .cart-item-info p:last-child {
            color: var(--text-gray);
            font-size: 0.875rem;
        }

        .cart-quantity {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .qty-btn {
            background-color: var(--primary-red);
            color: white;
            border: none;
            width: 24px;
            height: 24px;
            border-radius: 0.25rem;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .qty-btn:hover {
            background-color: #dc2626;
        }

        .cart-empty {
            text-align: center;
            color: var(--text-gray);
            padding: 2rem 1rem;
        }

        .cart-summary {
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
            margin-top: 1rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            color: var(--text-gray);
            font-size: 0.875rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-light);
        }

        .summary-total span:last-child {
            color: var(--primary-red);
        }

        .cart-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 1.5rem;
        }

        .cart-buttons button {
            padding: 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-btn {
            background-color: var(--primary-red);
color: white;
        }

        .checkout-btn:hover {
            background-color: #dc2626;
        }

        .continue-btn {
            background-color: transparent;
            color: var(--text-light);
            border: 2px solid var(--border-color);
        }

        .continue-btn:hover {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 2rem 1rem;
            background-color: rgba(10, 10, 10, 0.6);
            border-top: 1px solid var(--border-color);
            color: var(--text-gray);
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">🎬 SPECTARE</div>

            <div class="nav-links">
                <a href="#movies">Film</a>
                <a href="#food">Makanan</a>
                <a href="#locations">Lokasi</a>
            </div>

            <div class="nav-buttons">
                <button class="cart-btn" onclick="toggleCart()">
                    🛒
                    <span class="cart-badge" id="cartCount" style="display: none;">0</span>
                </button>
                 <div class="space-x-3">
                    <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 btn-glow px-4 py-2 rounded-lg text-white font-semibold transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-lg text-white font-semibold transition">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang di <span>Spectare</span></h1>
            <p class="hero-subtitle">
                Nikmati pengalaman menonton terbaik dengan teknologi bioskop terkini. Pesan tiket film favoritmu sekarang dan rasakan sensasinya!
            </p>
             <div class="space-x-4">
            {{-- Tombol aksi langsung ke login/register --}}
            <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 px-6 py-3 rounded-lg text-gray-900 font-bold text-lg transition">Mulai Nonton</a>
            <a href="{{ route('register') }}" class="bg-transparent border-2 border-red-400 hover:bg-red-500 hover:text-gray-900 px-6 py-3 rounded-lg text-red-400 font-bold text-lg transition">Daftar Sekarang</a>
        </div>
        </div>
    </section>

    <!-- GENRE FILTER -->
    <section class="genre-section" id="genres">
        <h2 class="section-title">Pilih <span>Genre</span> Favorit</h2>
        <div class="genre-filter scrollbar-hide">
            <button class="genre-btn active" onclick="filterByGenre(this, 'all')">Semua</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'action')">Action</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'comedy')">Komedi</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'drama')">Drama</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'horror')">Horror</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'animation')">Animasi</button>
            <button class="genre-btn" onclick="filterByGenre(this, 'romance')">Romance</button>
        </div>
    </section>

    <!-- MOVIES CAROUSEL -->
    <section class="movies-section" id="movies">
        <h2 class="section-title">Film <span>Terbaru</span></h2>
        <div class="carousel-container scrollbar-hide" id="moviesCarousel">
            <!-- Movie items akan di-generate oleh JavaScript -->
        </div>
    </section>

    <!-- LOCATIONS SECTION -->
    <section class="locations-section" id="locations">
        <h2 class="section-title" style="margin-bottom: 2rem;">Pilih <span>Lokasi</span> Bioskop</h2>
        <div class="locations-grid">
            <div class="location-card">
                <h3>🏢 Spectare Jakarta</h3>
                <p>Jl. Sudirman No. 123, Jakarta Pusat</p>
                <p>📞 (021) 1234-5678</p>
                <button onclick="selectLocation('Jakarta')">Pilih Lokasi</button>
            </div>
            <div class="location-card">
                <h3>🏢 Spectare Bandung</h3>
                <p>Jl. Braga No. 456, Bandung</p>
                <p>📞 (022) 2345-6789</p>
                <button onclick="selectLocation('Bandung')">Pilih Lokasi</button>
            </div>
            <div class="location-card">
                <h3>🏢 Spectare Surabaya</h3>
                <p>Jl. Pemuda No. 789, Surabaya</p>
                <p>📞 (031) 3456-7890</p>
                <button onclick="selectLocation('Surabaya')">Pilih Lokasi</button>
            </div>
        </div>
    </section>

    <!-- FOOD SECTION -->
    <section class="food-section" id="food">
        <h2 class="section-title" style="margin-bottom: 2rem;">Pesan <span>Makanan</span> & Minuman</h2>
        <div class="food-grid">
            <div class="food-card animate-slide-in">
                <img src="/placeholder.svg?height=180&width=250" alt="Popcorn Jumbo">
                <div class="food-card-content">
                    <h3>🍿 Popcorn Jumbo</h3>
                    <p>Popcorn renyah dengan rasa original</p>
                    <div class="food-card-footer">
                        <span class="food-price">Rp 45.000</span>
                        <button class="add-to-cart-btn" onclick="addToCart('Popcorn Jumbo', 45000)">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card animate-slide-in">
                <img src="/placeholder.svg?height=180&width=250" alt="Soft Drink">
                <div class="food-card-content">
                    <h3>🥤 Soft Drink Jumbo</h3>
                    <p>Minuman segar pilihan Anda</p>
                    <div class="food-card-footer">
                        <span class="food-price">Rp 35.000</span>
                        <button class="add-to-cart-btn" onclick="addToCart('Soft Drink Jumbo', 35000)">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card animate-slide-in">
                <img src="/placeholder.svg?height=180&width=250" alt="Hot Dog">
                <div class="food-card-content">
                    <h3>🌭 Hot Dog Premium</h3>
                    <p>Hot dog dengan topping lengkap</p>
                    <div class="food-card-footer">
                        <span class="food-price">Rp 55.000</span>
                        <button class="add-to-cart-btn" onclick="addToCart('Hot Dog Premium', 55000)">+</button>
                    </div>
                </div>
            </div>

            <div class="food-card animate-slide-in">
                <img src="/placeholder.svg?height=180&width=250" alt="Nachos">
                <div class="food-card-content">
                    <h3>🧀 Nachos Cheese</h3>
                    <p>Nachos dengan keju meleleh</p>
                    <div class="food-card-footer">
                        <span class="food-price">Rp 50.000</span>
                        <button class="add-to-cart-btn" onclick="addToCart('Nachos Cheese', 50000)">+</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        &copy; 2025 Spectare. All Rights Reserved. | Nikmati pengalaman bioskop terbaik bersama kami.
    </footer>

    <!-- MOVIE DETAIL MODAL -->
    <div id="movieModal" class="modal">
        <div class="modal-content">
            <div style="padding: 1.5rem;">
                <div class="modal-header">
                    <h2 id="modalTitle"></h2>
                    <button class="close-btn" onclick="closeMovieModal()">✕</button>
                </div>

                <img id="modalPoster" src="images/bc" alt="Poster" style="width: 100%; height: 256px; object-fit: cover; border-radius: 0.5rem; margin-bottom: 1.5rem;">

                <div style="space-y-4;">
                    <div style="margin-bottom: 1.5rem;">
                        <p class="modal-label">Genre</p>
                        <p id="modalGenre" style="font-weight: 600;"></p>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <p class="modal-label">Durasi</p>
                        <p id="modalDuration" style="font-weight: 600;"></p>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <p class="modal-label">Rating</p>
                        <p id="modalRating" style="font-weight: 600; color: #fbbf24;"></p>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <p class="modal-label">Sinopsis</p>
                        <p id="modalSynopsis" style="color: var(--text-gray); font-size: 0.875rem; line-height: 1.6;"></p>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <p class="modal-label" style="margin-bottom: 0.75rem;">Pilih Jam Tayang</p>
                        <div class="time-slots" id="timeSlots">
                            <!-- Time slots akan di-generate oleh JavaScript -->
                        </div>
                    </div>

                    <button class="btn-primary" style="width: 100%;" onclick="bookTicket()">Pesan Tiket</button>
                </div>
            </div>
        </div>
    </div>


    <!-- CART SIDEBAR -->
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-header">
            <h2>🛒 Keranjang</h2>
            <button class="close-btn" onclick="toggleCart()">✕</button>
        </div>

        <div class="cart-items" id="cartItems">
            <p class="cart-empty">Keranjang kosong</p>
        </div>

        <div class="cart-summary">
            <div class="summary-row">
                <span>Subtotal</span>
                <span id="subtotal">Rp 0</span>
            </div>
            <div class="summary-row">
                <span>Pajak (10%)</span>
                <span id="tax">Rp 0</span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span id="total">Rp 0</span>
            </div>
        </div>

        <div class="cart-buttons">
            <button class="checkout-btn">Checkout</button>
            <button class="continue-btn" onclick="toggleCart()">Lanjut Belanja</button>
        </div>
    </div>

    <script>
        // Data Film dengan kategori genre
        const movies = [
            {
                id: 1,
                title: "High & Low The Worst",
                genre: "action",
                genreText: "Action, Drama, Comedy",
                duration: "181 menit",
                rating: "8.4/10",
                synopsis: "Sebuah film action yang memukau dengan cerita penuh drama dan komedi yang menghibur.",
                poster: "images/hnl.jpg",
                times: ["10:00", "13:30", "16:45", "19:30", "22:00"],
                trailer: "https://www.youtube.com/embed/7k02A3_3Z-g?si=ABJwhi_n24x-52A8"
            },
            {
                id: 2,
                title: "Terrifier 3",
                genre: "horror",
                genreText: "Horror, Thriller",
                duration: "112 menit",
                rating: "7.5/10",
                synopsis: "Film horor yang mendebarkan dengan visual yang menakutkan dan cerita yang intens.",
                poster: "images/tr.jpg",
                times: ["11:00", "14:00", "17:15", "20:30"],
                trailer: "https://www.youtube.com/embed/jQ_bJ-I1E1o?si=P-s2s-iB-f_Y_Z-v"
            },
            {
                id: 3,
                title: "Weak Hero Class 1",
                genre: "drama",
                genreText: "Drama, Action",
                duration: "125 menit",
                rating: "8.6/10",
                synopsis: "Drama action yang menyentuh hati dengan karakter-karakter yang kuat dan cerita inspiratif.",
                poster: "images/wh.jpg",
                times: ["09:00", "12:00", "15:00", "18:00"],
                trailer: "https://www.youtube.com/embed/fB_v_I1Iq_w?si=L-g_Y_Z-v_I1Iq_w"
            },
            {
                id: 4,
                title: "Deadpool",
                genre: "comedy",
                genreText: "Comedy, Action, Drama",
                duration: "194 menit",
                rating: "7.8/10",
                synopsis: "Film action komedi yang lucu dan menghibur dengan banyak adegan seru dan lelucon.",
                poster: "images/dp.jpg",
                times: ["10:30", "14:30", "18:30", "21:00"],
                trailer: "https://www.youtube.com/embed/ONHBaC-pfsk?si=Q-s2s-iB-f_Y_Z-v"
            },
            {
                id: 5,
                title: "Black Clover",
                genre: "animation",
                genreText: "Action, Comedy",
                duration: "100 menit",
                rating: "7.7/10",
                synopsis: "Film animasi action dengan karakter-karakter seru dan cerita yang menghibur.",
                poster: "images/bc.jpg",
                times: ["11:30", "14:45", "17:30", "20:15"],
                trailer: "https://www.youtube.com/embed/p_t_Y_Z-v_I?si=L-g_Y_Z-v_I1Iq_w"
            },
            {
                id: 6,
                title: "Kaguya-Sama",
                genre: "romance",
                genreText: "Drama, Romance, Comedy",
                duration: "142 menit",
                rating: "9.3/10",
                synopsis: "Film romance yang romantis dengan cerita yang menyentuh hati dan karakter yang menarik.",
                poster: "images/ks.jpg",
                times: ["10:00", "13:00", "16:30", "19:45"],
                trailer: "https://youtu.be/feqFvfME4Qw?si=zFW1SzoqSi5zscdA"
            }
        ];

        let cart = [];
        let currentGenre = 'all';
        let currentMovieId = null;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderMovies();
        });

        // Render Movies
        function renderMovies() {
            const carousel = document.getElementById('moviesCarousel');
            carousel.innerHTML = '';

            const filtered = currentGenre === 'all'
                ? movies
                : movies.filter(m => m.genre === currentGenre);

            filtered.forEach((movie, index) => {
                const div = document.createElement('div');
                div.className = 'carousel-item';
                div.style.animation = `slide-in 0.6s ease-out ${index * 0.1}s both`;
                div.innerHTML = `
                    <img src="${movie.poster}" alt="${movie.title}" onclick="openTrailerModal('${movie.trailer}')">
                    <p class="carousel-item-title" onclick="openMovieModal(${movie.id})">${movie.title}</p>
                `;
                carousel.appendChild(div);
            });
        }

        // Filter by Genre
        function filterByGenre(btn, genre) {
            currentGenre = genre;

            document.querySelectorAll('.genre-btn').forEach(b => {
                b.classList.remove('active');
            });
            btn.classList.add('active');

            renderMovies();
        }

        // Open Movie Modal
        function openMovieModal(movieId) {
            const movie = movies.find(m => m.id === movieId);
            if (!movie) return;

            currentMovieId = movieId;

            document.getElementById('modalTitle').textContent = movie.title;
            document.getElementById('modalPoster').src = movie.poster;
            document.getElementById('modalGenre').textContent = movie.genreText;
            document.getElementById('modalDuration').textContent = movie.duration;
            document.getElementById('modalRating').textContent = movie.rating;
            document.getElementById('modalSynopsis').textContent = movie.synopsis;

            const timeSlots = document.getElementById('timeSlots');
            timeSlots.innerHTML = '';
            movie.times.forEach(time => {
                const btn = document.createElement('button');
                btn.className = 'time-slot';
                btn.textContent = time;
                btn.onclick = function() {
                    document.querySelectorAll('.time-slot').forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                };
                timeSlots.appendChild(btn);
            });

            document.getElementById('movieModal').classList.add('active');
        }

        // Close Movie Modal
        function closeMovieModal() {
            document.getElementById('movieModal').classList.remove('active');
        }

        // Open Trailer Modal
        function openTrailerModal(trailerUrl) {
            document.getElementById('trailerFrame').src = trailerUrl;
            document.getElementById('trailerModal').classList.add('active');
        }

        // Close Trailer Modal
        function closeTrailerModal() {
            document.getElementById('trailerModal').classList.remove('active');
            document.getElementById('trailerFrame').src = ''; // Stop the video
        }

        // Book Ticket
        function bookTicket() {
            const selectedTime = document.querySelector('.time-slot.selected');
            if (!selectedTime) {
                alert('Pilih jam tayang terlebih dahulu!');
                return;
            }
            alert('Tiket berhasil dipesan untuk jam ' + selectedTime.textContent);
            closeMovieModal();
        }

        // Select Location
        function selectLocation(location) {
            alert('Lokasi ' + location + ' dipilih!');
        }

        // Cart Functions
        function addToCart(name, price) {
            const item = cart.find(i => i.name === name);
            if (item) {
                item.quantity++;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            updateCart();
        }

        function updateCart() {
            const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            const cartBadge = document.getElementById('cartCount');

            if (cartCount > 0) {
                cartBadge.textContent = cartCount;
                cartBadge.style.display = 'flex';
            } else {
                cartBadge.style.display = 'none';
            }

            const cartItems = document.getElementById('cartItems');
            cartItems.innerHTML = '';

            if (cart.length === 0) {
                cartItems.innerHTML = '<p class="cart-empty">Keranjang kosong</p>';
            } else {
                cart.forEach((item, index) => {
                    const div = document.createElement('div');
                    div.className = 'cart-item';
                    div.innerHTML = `
                        <div class="cart-item-info">
                            <p>${item.name}</p>
                            <p>Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="cart-quantity">
                            <button class="qty-btn" onclick="decreaseQuantity(${index})">-</button>
                            <span>${item.quantity}</span>
                            <button class="qty-btn" onclick="increaseQuantity(${index})">+</button>
                        </div>
                    `;
                    cartItems.appendChild(div);
                });
            }

            updateCartTotal();
        }

        function increaseQuantity(index) {
            cart[index].quantity++;
            updateCart();
        }

        function decreaseQuantity(index) {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            } else {
                cart.splice(index, 1);
            }
            updateCart();
        }

        function updateCartTotal() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('tax').textContent = 'Rp ' + Math.round(tax).toLocaleString('id-ID');
            document.getElementById('total').textContent = 'Rp ' + Math.round(total).toLocaleString('id-ID');
        }

        function toggleCart() {
            const sidebar = document.getElementById('cartSidebar');
            sidebar.classList.toggle('active');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const movieModal = document.getElementById('movieModal');
            const trailerModal = document.getElementById('trailerModal');
            if (event.target == movieModal) {
                closeMovieModal();
            }
            if (event.target == trailerModal) {
                closeTrailerModal();
            }
        }
    </script>
</body>
</html>
