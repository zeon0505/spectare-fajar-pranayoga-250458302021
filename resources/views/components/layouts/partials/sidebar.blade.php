 <aside class="sidebar w-64 bg-gradient-to-b from-slate-900 to-slate-950 border-r border-amber-500/20 overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11z"/>
                        </svg>
                    </div>
                    <h1 class="text-xl font-bold accent-amber">Spectare</h1>
                </div>

                <nav class="space-y-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-4">Menu</div>

                    <a href="{{ route('user.dashboard') }}" class="menu-item active block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Bookings
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Booking Seat
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Genre
                    </a>
                     <a href="{{ route('user.films.index') }}" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Film
                    </a>
                     <a href="" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Review
                    </a>
                     <a href="{{ route('user.films.show') }}" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Showtime
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Studio
                    </a>
                     <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                        Transaction
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Reports
                    </a>

                    <div class="text-xs font-semibold text-gray-400 uppercase my-4 pt-4 border-t border-slate-700">Settings</div>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.62l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94L14.4 2.81c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41L9.25 5.35C8.66 5.59 8.12 5.92 7.63 6.29L5.24 5.33c-.22-.08-.47 0-.59.22L2.74 8.87c-.13.21-.08.48.1.62l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.62l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.48-.12-.62l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
                        </svg>
                        Settings
                    </a>

                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Support
                    </a>
                    <a href="#" class="menu-item block px-4 py-3 rounded-lg transition-all duration-300">
                        <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
                        Keluar atau Dikeluarin
                    </a>
                </nav>
            </div>
        </aside>
