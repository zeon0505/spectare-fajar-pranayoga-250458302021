<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineTicket - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0a0a0a;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .carousel-container {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            gap: 1.5rem;
            padding: 1rem;
            scroll-snap-type: x mandatory;
        }

        .carousel-item {
            flex: 0 0 200px;
            scroll-snap-align: start;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .carousel-item:hover {
            transform: scale(1.05);
        }

        .carousel-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid transparent;
            transition: border-color 0.3s ease;
        }

        .carousel-item:hover img {
            border-color: #ef4444;
        }

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
            background-color: #1a1a1a;
            border: 2px solid #ef4444;
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

        .genre-filter {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            padding: 1rem;
            scroll-behavior: smooth;
        }

        .genre-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #ffffff;
            background-color: transparent;
            color: #ffffff;
            border-radius: 2rem;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .genre-btn:hover,
        .genre-btn.active {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .food-card {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            border-radius: 0.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .food-card:hover {
            border-color: #ef4444;
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.2);
        }

        .food-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .add-to-cart-btn {
            background-color: #ef4444;
            color: #ffffff;
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

        .btn-primary {
            background-color: #ef4444;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #dc2626;
        }

        .btn-secondary {
            background-color: transparent;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: 2px solid #ffffff;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #ffffff;
            color: #0a0a0a;
        }

        .navbar {
            background-color: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #333333;
            top: 0;
            z-index: 40;
            transition: all 0.3s ease;
        }

        .hero-section {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 4rem 1rem;
            text-align: center;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #ffffff;
        }

        .section-title span {
            color: #ef4444;
        }

        .location-card {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            border-radius: 0.5rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .location-card:hover {
            border-color: #ef4444;
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.2);
        }

        .time-slot {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .time-slot:hover,
        .time-slot.selected {
            background-color: #ef4444;
            border-color: #ef4444;
        }

        .cart-badge {
            background-color: #ef4444;
            color: #ffffff;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .close-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #ef4444;
        }

        .rating {
            color: #fbbf24;
            font-size: 0.875rem;
        }

        .price {
            color: #ef4444;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .user-profile-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border: 1px solid #ef4444;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .user-info h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .user-info p {
            color: #999999;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .watchlist-section {
            background-color: #1a1a1a;
            border: 1px solid #333333;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .logout-btn {
            background-color: #dc2626;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .logout-btn:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar sticky">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl font-bold text-red-500 tracking-wide">CineTicket</span>
            </div>

            <div class="hidden md:flex items-center gap-8 text-gray-300 font-medium">
                <a href="#movies" class="hover:text-red-500 transition">Film</a>
                <a href="#food" class="hover:text-red-500 transition">Makanan</a>
                <a href="#locations" class="hover:text-red-500 transition">Lokasi</a>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                    <button onclick="toggleCart()" class="relative p-2 hover:text-red-500 transition text-lg">
                        🛒
                        <span class="cart-badge absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold" id="cartCount" style="display: none;">0</span>
                    </button>
                </div>
                <div class="space-x-3 flex items-center">
                    <span id="userGreeting" class="text-sm font-semibold text-red-500"></span>
                    <button onclick="handleLogout()" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-white font-semibold transition">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- USER PROFILE SECTION -->
    <section class="py-8 px-4 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="user-profile-card">
                <div class="flex items-start gap-6">
                    <div class="user-avatar" id="userAvatarDisplay">U</div>
                    <div class="user-info flex-1">
                        <h2 id="userDisplayName">User</h2>
                        <p id="userDisplayEmail">user@email.com</p>
                        <p id="userDisplayUsername">@username</p>
                        <p id="userJoinDate" class="mt-2 text-xs text-gray-500"></p>
                    </div>
                    <button onclick="openProfileEdit()" class="btn-primary">Edit Profil</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="watchlist-section text-center">
                    <p class="text-gray-400 text-sm mb-2">Film Ditonton</p>
                    <p class="text-3xl font-bold text-red-500">0</p>
                </div>
                <div class="watchlist-section text-center">
                    <p class="text-gray-400 text-sm mb-2">Watchlist</p>
                    <p class="text-3xl font-bold text-red-500">0</p>
                </div>
                <div class="watchlist-section text-center">
                    <p class="text-gray-400 text-sm mb-2">Total Pengeluaran</p>
                    <p class="text-3xl font-bold text-red-500">Rp 0</p>
                </div>
            </div>
        </div>
    </section>

    <!-- GENRE FILTER -->
    <section class="py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="section-title mb-6">Pilih <span>Genre</span> Favorit</h2>
            <div class="genre-filter scrollbar-hide">
                <button class="genre-btn active" onclick="filterByGenre('all')">Semua</button>
                <button class="genre-btn" onclick="filterByGenre('action')">Action</button>
                <button class="genre-btn" onclick="filterByGenre('comedy')">Komedi</button>
                <button class="genre-btn" onclick="filterByGenre('drama')">Drama</button>
                <button class="genre-btn" onclick="filterByGenre('horror')">Horror</button>
                <button class="genre-btn" onclick="filterByGenre('animation')">Animasi</button>
                <button class="genre-btn" onclick="filterByGenre('romance')">Romance</button>
            </div>
        </div>
    </section>

    <!-- MOVIES CAROUSEL -->
    <section id="movies" class="py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="section-title mb-6">Film <span>Terbaru</span></h2>
            <div class="carousel-container scrollbar-hide" id="moviesCarousel">
                <!-- Movie items akan di-generate oleh JavaScript -->
            </div>
        </div>
    </section>

    <!-- LOCATIONS SECTION -->
    <section id="locations" class="py-12 px-4 bg-gray-950">
        <div class="max-w-7xl mx-auto">
            <h2 class="section-title mb-8">Pilih <span>Lokasi</span> Bioskop</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="location-card">
                    <h3 class="text-lg font-bold mb-2">Spectare Jakarta</h3>
                    <p class="text-gray-400 text-sm mb-4">Jl. Sudirman No. 123, Jakarta Pusat</p>
                    <p class="text-sm mb-4">📞 (021) 1234-5678</p>
                    <button class="btn-primary w-full text-sm">Pilih Lokasi</button>
                </div>
                <div class="location-card">
                    <h3 class="text-lg font-bold mb-2">Spectare Bandung</h3>
                    <p class="text-gray-400 text-sm mb-4">Jl. Braga No. 456, Bandung</p>
                    <p class="text-sm mb-4">📞 (022) 2345-6789</p>
                    <button class="btn-primary w-full text-sm">Pilih Lokasi</button>
                </div>
                <div class="location-card">
                    <h3 class="text-lg font-bold mb-2">Spectare Surabaya</h3>
                    <p class="text-gray-400 text-sm mb-4">Jl. Pemuda No. 789, Surabaya</p>
                    <p class="text-sm mb-4">📞 (031) 3456-7890</p>
                    <button class="btn-primary w-full text-sm">Pilih Lokasi</button>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOD SECTION -->
    <section id="food" class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="section-title mb-8">Pesan <span>Makanan</span> & Minuman</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="food-card">
                    <img src="/placeholder.svg?height=150&width=200" alt="Popcorn">
                    <div class="p-4">
                        <h3 class="font-bold mb-2">Popcorn Jumbo</h3>
                        <p class="text-gray-400 text-sm mb-3">Popcorn renyah dengan rasa original</p>
                        <div class="flex justify-between items-center">
                            <span class="price">Rp 45.000</span>
                            <button class="add-to-cart-btn" onclick="addToCart('Popcorn Jumbo', 45000)">+</button>
                        </div>
                    </div>
                </div>

                <div class="food-card">
                    <img src="/placeholder.svg?height=150&width=200" alt="Soft Drink">
                    <div class="p-4">
                        <h3 class="font-bold mb-2">Soft Drink Jumbo</h3>
                        <p class="text-gray-400 text-sm mb-3">Minuman segar pilihan Anda</p>
                        <div class="flex justify-between items-center">
                            <span class="price">Rp 35.000</span>
                            <button class="add-to-cart-btn" onclick="addToCart('Soft Drink Jumbo', 35000)">+</button>
                        </div>
                    </div>
                </div>

                <div class="food-card">
                    <img src="/placeholder.svg?height=150&width=200" alt="Hot Dog">
                    <div class="p-4">
                        <h3 class="font-bold mb-2">Hot Dog Premium</h3>
                        <p class="text-gray-400 text-sm mb-3">Hot dog dengan topping lengkap</p>
                        <div class="flex justify-between items-center">
                            <span class="price">Rp 55.000</span>
                            <button class="add-to-cart-btn" onclick="addToCart('Hot Dog Premium', 55000)">+</button>
                        </div>
                    </div>
                </div>

                <div class="food-card">
                    <img src="/placeholder.svg?height=150&width=200" alt="Nachos">
                    <div class="p-4">
                        <h3 class="font-bold mb-2">Nachos Cheese</h3>
                        <p class="text-gray-400 text-sm mb-3">Nachos dengan keju meleleh</p>
                        <div class="flex justify-between items-center">
                            <span class="price">Rp 50.000</span>
                            <button class="add-to-cart-btn" onclick="addToCart('Nachos Cheese', 50000)">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center py-6 bg-gray-800 text-gray-400 text-sm">
        &copy; 2025 Spectare. All Rights Reserved.
    </footer>

    <!-- MOVIE DETAIL MODAL -->
    <div id="movieModal" class="modal">
        <div class="modal-content">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold"></h2>
                    <button class="close-btn" onclick="closeMovieModal()">✕</button>
                </div>

                <img id="modalPoster" src="/placeholder.svg?height=300&width=400" alt="Poster" class="w-full h-64 object-cover rounded mb-4">

                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm">Genre</p>
                        <p id="modalGenre" class="font-semibold"></p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm">Durasi</p>
                        <p id="modalDuration" class="font-semibold"></p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm">Rating</p>
                        <p id="modalRating" class="font-semibold rating"></p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm mb-2">Sinopsis</p>
                        <p id="modalSynopsis" class="text-gray-300 text-sm leading-relaxed"></p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm mb-3">Pilih Jam Tayang</p>
                        <div class="grid grid-cols-3 gap-2" id="timeSlots">
                            <!-- Time slots akan di-generate oleh JavaScript -->
                        </div>
                    </div>

                    <button class="btn-primary w-full" onclick="bookTicket()">Pesan Tiket</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CART SIDEBAR -->
    <div id="cartSidebar" class="fixed right-0 top-0 h-full w-80 bg-gray-900 border-l border-gray-700 transform translate-x-full transition-transform duration-300 z-30 overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Keranjang</h2>
                <button class="close-btn" onclick="toggleCart()">✕</button>
            </div>

            <div id="cartItems" class="space-y-4 mb-6">
                <!-- Cart items akan di-generate oleh JavaScript -->
            </div>

            <div class="border-t border-gray-700 pt-4 mb-6">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-400">Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-400">Pajak (10%)</span>
                    <span id="tax">Rp 0</span>
                </div>
                <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span id="total" class="text-red-600">Rp 0</span>
                </div>
            </div>

            <button class="btn-primary w-full mb-2">Checkout</button>
            <button class="btn-secondary w-full" onclick="toggleCart()">Lanjut Belanja</button>
        </div>
    </div>

    <script>
        // Check if user is logged in
        function checkUserLogin() {
            const user = JSON.parse(localStorage.getItem('currentUser'));
            if (!user || !user.isLoggedIn) {
                window.location.href = 'index.html';
                return;
            }
            displayUserInfo(user);
        }

        // Display user information
        function displayUserInfo(user) {
            const username = user.username || user.fullname || 'User';
            const email = user.email || 'user@email.com';
            const initials = username.substring(0, 1).toUpperCase();

            document.getElementById('userGreeting').textContent = `Halo, ${username}!`;
            document.getElementById('userAvatarDisplay').textContent = initials;
            document.getElementById('userDisplayName').textContent = user.fullname || username;
            document.getElementById('userDisplayEmail').textContent = email;
            document.getElementById('userDisplayUsername').textContent = `@${username}`;

            const joinDate = new Date(user.loginTime || user.registerTime).toLocaleDateString('id-ID');
            document.getElementById('userJoinDate').textContent = `Bergabung: ${joinDate}`;
        }

        // Logout handler
        function handleLogout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                localStorage.removeItem('currentUser');
                window.location.href = 'index.html';
            }
        }

        // Edit profile placeholder
        function openProfileEdit() {
            alert('Fitur edit profil akan segera tersedia');
        }

        // Data Film
        const movies = [
            {
                id: 1,
                title: "High & Low The Worst",
                genre: "Action, Drama, Comedy",
                duration: "181 menit",
                rating: "8.4/10",
                synopsis: "Setelah peristiwa menghancurkan di Infinity War, para Avengers yang tersisa berkumpul untuk melakukan satu upaya terakhir untuk menyelamatkan dunia.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["10:00", "13:30", "16:45", "19:30", "22:00"]
            },
            {
                id: 2,
                title: "Terrifier 3",
                genre: "Horror, Thriller",
                duration: "112 menit",
                rating: "7.5/10",
                synopsis: "Paranormal investigators bekerja untuk membantu keluarga yang dikejar oleh entitas gelap di rumah mereka.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["11:00", "14:00", "17:15", "20:30"]
            },
            {
                id: 3,
                title: "Weak Hero Class 1",
                genre: "Drama, Action",
                duration: "125 menit",
                rating: "8.6/10",
                synopsis: "Seorang gadis muda memasuki dunia sihir yang aneh ketika orang tuanya berubah menjadi babi.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["09:00", "12:00", "15:00", "18:00"]
            },
            {
                id: 4,
                title: "Deadpool",
                genre: "Comedy, Action, Drama",
                duration: "194 menit",
                rating: "7.8/10",
                synopsis: "Dua penumpang dari kelas sosial yang berbeda jatuh cinta di kapal Titanic yang akan tenggelam.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["10:30", "14:30", "18:30", "21:00"]
            },
            {
                id: 5,
                title: "Black Clover",
                genre: "Action, Comedy",
                duration: "100 menit",
                rating: "7.7/10",
                synopsis: "Tiga teman mencoba mengingat malam yang hilang setelah pesta liar di Las Vegas.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["11:30", "14:45", "17:30", "20:15"]
            },
            {
                id: 6,
                title: "Kaguya-Sama",
                genre: "Drama, Romance, Comedy",
                duration: "142 menit",
                rating: "9.3/10",
                synopsis: "Dua tahanan membentuk ikatan yang kuat sambil merencanakan pelarian dari penjara yang brutal.",
                poster: "/placeholder.svg?height=300&width=200",
                times: ["10:00", "13:00", "16:30", "19:45"]
            }
        ];

        let cart = [];
        let currentGenre = 'all';

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            checkUserLogin();
            renderMovies();
        });

        // Render Movies
        function renderMovies() {
            const carousel = document.getElementById('moviesCarousel');
            carousel.innerHTML = '';

            const filtered = currentGenre === 'all'
                ? movies
                : movies.filter(m => m.genre.toLowerCase().includes(currentGenre.toLowerCase()));

            filtered.forEach(movie => {
                const div = document.createElement('div');
                div.className = 'carousel-item';
                div.innerHTML = `
                    <img src="${movie.poster}" alt="${movie.title}" onclick="openMovieModal(${movie.id})">
                    <p class="text-sm mt-2 text-center font-semibold">${movie.title}</p>
                `;
                carousel.appendChild(div);
            });
        }

        // Filter by Genre
        function filterByGenre(genre) {
            currentGenre = genre;

            document.querySelectorAll('.genre-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            renderMovies();
        }

        // Open Movie Modal
        function openMovieModal(movieId) {
            const movie = movies.find(m => m.id === movieId);
            if (!movie) return;

            document.getElementById('modalTitle').textContent = movie.title;
            document.getElementById('modalPoster').src = movie.poster;
            document.getElementById('modalGenre').textContent = movie.genre;
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

        // Cart Functions
        function addToCart(name, price) {
            const item = cart.find(i => i.name === name);
            if (item) {
                item.quantity++;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            updateCart();
            alert(name + ' ditambahkan ke keranjang!');
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
                cartItems.innerHTML = '<p class="text-gray-400 text-center py-8">Keranjang kosong</p>';
            } else {
                cart.forEach((item, index) => {
                    const div = document.createElement('div');
                    div.className = 'bg-gray-800 p-4 rounded flex justify-between items-center';
                    div.innerHTML = `
                        <div>
                            <p class="font-semibold">${item.name}</p>
                            <p class="text-gray-400 text-sm">Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="decreaseQuantity(${index})" class="bg-red-600 px-2 py-1 rounded">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="increaseQuantity(${index})" class="bg-red-600 px-2 py-1 rounded">+</button>
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
            sidebar.classList.toggle('translate-x-full');
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const movieModal = document.getElementById('movieModal');
            if (event.target === movieModal) {
                movieModal.classList.remove('active');
            }
        }
    </script>
</body>
</html>
