<main class="flex-1 overflow-auto">
            <!-- HEADER -->
            <header class="bg-gradient-to-r from-slate-900 to-slate-800 border-b border-amber-500/20 sticky top-0 z-30">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="hamburger md:hidden text-amber-400 hover:text-amber-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h2 class="text-2xl font-bold text-white">Films Collection</h2>
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
                <!-- SEARCH AND FILTER -->
                <div class="card-cinema card-hover p-6 rounded-lg mb-8">
                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Search Films</label>
                            <input type="text" placeholder="Enter film title..." class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">Genre</label>
                            <select class="bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50">
                                <option>All Genres</option>
                                <option>Action</option>
                                <option>Drama</option>
                                <option>Comedy</option>
                                <option>Horror</option>
                            </select>
                        </div>
                        <button class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded-lg transition-colors">Filter</button>
                    </div>
                </div>

                <!-- FILMS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Film Card 1 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-amber-500/20 to-red-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-amber-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">The Quantum Escape</h3>
                            <p class="text-xs text-gray-400 mb-3">Action • Sci-Fi • 2h 18m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">8.5/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.50.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
                        </div>
                    </div>

                    <!-- Film Card 2 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-purple-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Hearts Unbound</h3>
                            <p class="text-xs text-gray-400 mb-3">Romance • Drama • 2h 5m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">7.8/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.45.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
                        </div>
                    </div>

                    <!-- Film Card 3 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-green-500/20 to-blue-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-green-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Jungle Chronicles</h3>
                            <p class="text-xs text-gray-400 mb-3">Adventure • Documentary • 1h 52m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">9.0/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.40.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
                        </div>
                    </div>

                    <!-- Film Card 4 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-red-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Dark Shadows Rising</h3>
                            <p class="text-xs text-gray-400 mb-3">Horror • Thriller • 1h 58m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">8.2/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.50.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
                        </div>
                    </div>

                    <!-- Film Card 5 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-indigo-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">The Last Horizon</h3>
                            <p class="text-xs text-gray-400 mb-3">Sci-Fi • Drama • 2h 25m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">8.7/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.55.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
                        </div>
                    </div>

                    <!-- Film Card 6 -->
                    <div class="film-card card-cinema card-hover rounded-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 flex items-center justify-center">
                            <svg class="w-20 h-20 text-cyan-400/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                            </svg>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-2">Ocean's Mystery</h3>
                            <p class="text-xs text-gray-400 mb-3">Thriller • Mystery • 2h 1m</p>
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="text-sm font-semibold accent-amber ml-1">8.4/10</span>
                                </div>
                                <span class="text-sm accent-amber font-semibold">Rp.48.000</span>
                            </div>
                            <button class="w-full px-3 py-2 bg-amber-500 hover:bg-amber-600 text-slate-900 font-semibold rounded transition-colors">View Details</button>
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
