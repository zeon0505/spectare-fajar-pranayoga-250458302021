<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Spectare</title>
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

        .review-card {
            animation: slideInLeft 0.7s ease-out forwards;
        }

        .review-card:nth-child(2) { animation-delay: 0.1s; }
        .review-card:nth-child(3) { animation-delay: 0.2s; }
        .review-card:nth-child(4) { animation-delay: 0.3s; }
        .review-card:nth-child(5) { animation-delay: 0.4s; }

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
        <!-- SIDEBAR -->

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
                        <h2 class="text-2xl font-bold text-white">Film Reviews</h2>
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
                <!-- SORT OPTIONS -->
                <div class="card-cinema card-hover p-6 rounded-lg mb-8">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Filter by Film</label>
                            <input type="text" placeholder="Search films..." class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Sort By</label>
                            <select class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
                                <option>Latest</option>
                                <option>Highest Rated</option>
                                <option>Lowest Rated</option>
                                <option>Most Helpful</option>
                            </select>
                        </div>
                        <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Apply</button>
                    </div>
                </div>

                <!-- REVIEWS LIST -->
                <div class="space-y-6">
                    <!-- Review 1 -->
                    <div class="review-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="/avatar-1.jpg" alt="Amanda Johnson avatar" class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 object-cover" onerror="this.src='/placeholder.svg?height=48&width=48'">
                                <div>
                                    <h3 class="text-lg font-bold text-white">The Quantum Escape - Outstanding!</h3>
                                    <p class="text-xs text-gray-400">By Amanda Johnson • 2 days ago</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end mb-1">
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <span class="text-sm font-semibold accent-amber">5.0/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-4">This film is absolutely spectacular! The cinematography is breathtaking, the storyline keeps you on the edge of your seat, and the cast delivers phenomenal performances. Highly recommended for sci-fi enthusiasts!</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H9a2 2 0 01-2-2v-6a2 2 0 012-2h.5a2 2 0 002-2v-.5a2 2 0 012-2h1"></path></svg>
                                    <span class="text-sm">125</span>
                                </button>
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.646-7.23a2 2 0 011.789-1.106H15a2 2 0 012 2v6a2 2 0 01-2 2h-.5a2 2 0 00-2 2v-.5a2 2 0 00-2 2h1"></path></svg>
                                    <span class="text-sm">12</span>
                                </button>
                            </div>
                            <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
                        </div>
                    </div>

                    <!-- Review 2 -->
                    <div class="review-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="/avatar-2.jpg" alt="Marcus Chen avatar" class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-purple-600 object-cover" onerror="this.src='/placeholder.svg?height=48&width=48'">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Hearts Unbound - Emotional Masterpiece</h3>
                                    <p class="text-xs text-gray-400">By Marcus Chen • 5 days ago</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end mb-1">
                                    <span class="text-yellow-400">★★★★☆</span>
                                </div>
                                <span class="text-sm font-semibold accent-amber">4.5/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-4">A truly touching romance that explores the depths of human connection. The chemistry between the leads is evident from the first frame. Some minor pacing issues in the second half, but overall a beautiful piece of cinema.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H9a2 2 0 01-2-2v-6a2 2 0 012-2h.5a2 2 0 002-2v-.5a2 2 0 012-2h1"></path></svg>
                                    <span class="text-sm">89</span>
                                </button>
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.646-7.23a2 2 0 011.789-1.106H15a2 2 0 012 2v6a2 2 0 01-2 2h-.5a2 2 0 00-2 2v-.5a2 2 0 00-2 2h1"></path></svg>
                                    <span class="text-sm">8</span>
                                </button>
                            </div>
                            <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
                        </div>
                    </div>

                    <!-- Review 3 -->
                    <div class="review-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="/avatar-3.jpg" alt="Sarah Park avatar" class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 object-cover" onerror="this.src='/placeholder.svg?height=48&width=48'">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Jungle Chronicles - Nature's Wonders</h3>
                                    <p class="text-xs text-gray-400">By Sarah Park • 1 week ago</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end mb-1">
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <span class="text-sm font-semibold accent-amber">5.0/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-4">A breathtaking documentary that captures the raw beauty and complexity of nature. The cinematography alone is worth the ticket price. Every frame is a work of art. Perfect for family viewing!</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H9a2 2 0 01-2-2v-6a2 2 0 012-2h.5a2 2 0 002-2v-.5a2 2 0 012-2h1"></path></svg>
                                    <span class="text-sm">156</span>
                                </button>
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.646-7.23a2 2 0 011.789-1.106H15a2 2 0 012 2v6a2 2 0 01-2 2h-.5a2 2 0 00-2 2v.5a2 2 0 00-2 2h1"></path></svg>
                                    <span class="text-sm">5</span>
                                </button>
                            </div>
                            <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
                        </div>
                    </div>

                    <!-- Review 4 -->
                    <div class="review-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="/avatar-4.jpg" alt="David Roberts avatar" class="w-12 h-12 rounded-full bg-gradient-to-br from-red-400 to-red-600 object-cover" onerror="this.src='/placeholder.svg?height=48&width=48'">
                                <div>
                                    <h3 class="text-lg font-bold text-white">Dark Shadows Rising - Thrilling Experience</h3>
                                    <p class="text-xs text-gray-400">By David Roberts • 1 week ago</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end mb-1">
                                    <span class="text-yellow-400">★★★★☆</span>
                                </div>
                                <span class="text-sm font-semibold accent-amber">4.0/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-4">A nail-biting horror-thriller that delivers genuine scares without relying on jump scares. The atmosphere is meticulously crafted. Would have appreciated a stronger ending, but overall highly entertaining.</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H9a2 2 0 01-2-2v-6a2 2 0 012-2h.5a2 2 0 002-2v-.5a2 2 0 012-2h1"></path></svg>
                                    <span class="text-sm">102</span>
                                </button>
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.646-7.23a2 2 0 011.789-1.106H15a2 2 0 012 2v6a2 2 0 01-2 2h-.5a2 2 0 00-2 2v-.5a2 2 0 00-2 2h1"></path></svg>
                                    <span class="text-sm">15</span>
                                </button>
                            </div>
                            <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
                        </div>
                    </div>

                    <!-- Review 5 -->
                    <div class="review-card card-cinema card-hover p-6 rounded-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <img src="/avatar-5.jpg" alt="Elena Li avatar" class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 object-cover" onerror="this.src='/placeholder.svg?height=48&width=48'">
                                <div>
                                    <h3 class="text-lg font-bold text-white">The Last Horizon - Epic Storytelling</h3>
                                    <p class="text-xs text-gray-400">By Elena Li • 2 weeks ago</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end mb-1">
                                    <span class="text-yellow-400">★★★★★</span>
                                </div>
                                <span class="text-sm font-semibold accent-amber">4.8/5</span>
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-4">This film is a triumph in storytelling and visual effects. The narrative explores profound themes while maintaining compelling character development. An absolute must-watch for science fiction lovers!</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-4">
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H9a2 2 0 01-2-2v-6a2 2 0 012-2h.5a2 2 0 002-2v-.5a2 2 0 012-2h1"></path></svg>
                                    <span class="text-sm">234</span>
                                </button>
                                <button class="text-gray-400 hover:text-amber-400 transition-colors flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.646-7.23a2 2 0 011.789-1.106H15a2 2 0 012 2v6a2 2 0 01-2 2h-.5a2 2 0 00-2 2v-.5a2 2 0 00-2 2h1"></path></svg>
                                    <span class="text-sm">3</span>
                                </button>
                            </div>
                            <button class="px-4 py-1 bg-amber-500/20 hover:bg-amber-500/30 text-amber-400 rounded text-sm font-semibold transition-colors">Report</button>
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
    </script>
</body>
</html>
