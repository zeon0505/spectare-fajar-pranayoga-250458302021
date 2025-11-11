<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Showtimes - Spectare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .card-cinema {
            animation: fadeIn 0.6s ease-out forwards;
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.9) 100%);
            border: 1px solid rgba(251, 191, 36, 0.2);
            backdrop-filter: blur(10px);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(251, 191, 36, 0.6);
            box-shadow: 0 10px 40px rgba(251, 191, 36, 0.15);
        }

        .showtime-card {
            animation: slideInLeft 0.7s ease-out forwards;
        }

        .showtime-card:nth-child(2) { animation-delay: 0.1s; }
        .showtime-card:nth-child(3) { animation-delay: 0.2s; }
        .showtime-card:nth-child(4) { animation-delay: 0.3s; }
        .showtime-card:nth-child(5) { animation-delay: 0.4s; }
        .showtime-card:nth-child(6) { animation-delay: 0.5s; }

        .accent-amber {
            color: #fbbf24;
        }

        .menu-item:hover {
            background-color: rgba(251, 191, 36, 0.1);
            color: #fbbf24;
        }

        .menu-item.active {
            background-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border-left: 3px solid #fbbf24;
        }

        .hamburger {
            display: none;
        }

        .time-slot {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .time-slot:hover {
            background-color: rgba(251, 191, 36, 0.2);
            border-color: rgba(251, 191, 36, 0.8);
        }

        .time-slot.selected {
            background-color: rgba(251, 191, 36, 0.4);
            border-color: rgba(251, 191, 36, 1);
            color: #fbbf24;
        }

        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 40;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-gray-100">

    <div class="flex h-screen overflow-hidden">
        <!-- SIDEBAR --> <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">

        <!-- MAIN CONTENT -->
            <!-- HEADER -->
            <header class="bg-gradient-to-r from-slate-900 to-slate-800 border-b border-amber-500/20 sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="hamburger md:hidden text-amber-400 hover:text-amber-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold text-white">Showtimes & Bookings</h2>
                    </div>
                    <div class="flex items-center space-x-6">
                        <button class="relative text-gray-300 hover:text-amber-400 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center cursor-pointer hover:shadow-lg hover:shadow-amber-500/50 transition-all">
                            <span class="text-sm font-bold text-slate-900">JD</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <div class="p-8">
                <!-- DATE SELECTOR -->
                <div class="card-cinema card-hover p-6 rounded-lg mb-8">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Select Date</label>
                            <input type="date" class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Select Film</label>
                            <select class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
                                <option>All Films</option>
                                <option>The Quantum Escape</option>
                                <option>Hearts Unbound</option>
                                <option>Jungle Chronicles</option>
                                <option>Dark Shadows Rising</option>
                            </select>
                        </div>
                        <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Search</button>
                    </div>
                </div>

                <!-- SHOWTIME CARDS -->
                <div class="space-y-6">
                    <!-- Showtime 1 -->
                    <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">The Quantum Escape</h3>
                                <p class="text-gray-400">Action • Sci-Fi • 2h 18m • Rating: 8.5/10</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Studio 1</p>
                                <p class="text-amber-400 font-bold text-lg">Rp.50.000</p>
                            </div>
                        </div>
                        <div class="h-px bg-slate-700 my-4"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">09:00 AM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">12:30 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold selected">03:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">06:30 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">09:00 PM</button>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Showtime 2 -->
                    <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">Hearts Unbound</h3>
                                <p class="text-gray-400">Romance • Drama • 2h 5m • Rating: 7.8/10</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Studio 2</p>
                                <p class="text-amber-400 font-bold text-lg">Rp.45.000</p>
                            </div>
                        </div>
                        <div class="h-px bg-slate-700 my-4"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">10:00 AM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">01:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">04:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold selected">07:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">10:00 PM</button>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Showtime 3 -->
                    <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">Jungle Chronicles</h3>
                                <p class="text-gray-400">Adventure • Documentary • 1h 52m • Rating: 9.0/10</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Studio 3</p>
                                <p class="text-amber-400 font-bold text-lg">Rp.40.000</p>
                            </div>
                        </div>
                        <div class="h-px bg-slate-700 my-4"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">08:00 AM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold selected">11:00 AM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">02:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">05:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">08:00 PM</button>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Showtime 4 -->
                    <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">Dark Shadows Rising</h3>
                                <p class="text-gray-400">Horror • Thriller • 1h 58m • Rating: 8.2/10</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Studio 4</p>
                                <p class="text-amber-400 font-bold text-lg">Rp.50.000</p>
                            </div>
                        </div>
                        <div class="h-px bg-slate-700 my-4"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">07:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">09:30 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold selected">11:45 PM</button>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Book Now</button>
                        </div>
                    </div>

                    <!-- Showtime 5 -->
                    <div class="showtime-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2">The Last Horizon</h3>
                                <p class="text-gray-400">Sci-Fi • Drama • 2h 25m • Rating: 8.7/10</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-400 text-sm">Studio 5</p>
                                <p class="text-amber-400 font-bold text-lg">Rp.55.000</p>
                            </div>
                        </div>
                        <div class="h-px bg-slate-700 my-4"></div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">11:00 AM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">02:30 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold hover:border-amber-500 transition-all">06:00 PM</button>
                            <button class="time-slot border border-slate-600 rounded-lg py-3 px-2 text-center font-semibold selected">09:00 PM</button>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <footer class="border-t border-slate-700/50 bg-slate-900/50 py-6 px-8 mt-8">
                <div class="flex flex-col md:flex-row items-center justify-between text-gray-400 text-sm">
                    <p>&copy; 2025 Spectare Cinema. All rights reserved.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="hover:text-amber-400 transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">Contact Us</a>
                    </div>
                </div>
            </footer>
        </main>
    </div>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');

        hamburger?.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.sidebar') && !e.target.closest('.hamburger')) {
                sidebar.classList.remove('open');
            }
        });

        // Time slot selection
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.addEventListener('click', function() {
                this.parentElement.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
