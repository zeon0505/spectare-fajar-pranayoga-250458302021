<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    @if (session()->has('message'))
        <div class="bg-green-500/10 border-l-4 border-green-500 text-green-400 px-5 py-4 rounded-lg relative mb-8 shadow-md flex items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="block sm:inline font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">

        <div class="p-6 sm:p-10 border-b border-slate-700 relative overflow-hidden">
            <div class="absolute inset-0 bg-slate-900 opacity-50 z-0"></div>
            <div class="absolute inset-0 bg-cover bg-center blur-3xl opacity-20 z-0" style="background-image: url('{{ asset('storage/' . $film->poster_url) }}')"></div>
            <div class="relative z-10 flex flex-col md:flex-row gap-8">
                <div class="md:w-1/3 lg:w-1/4 flex-shrink-0">
                    <div class="relative group">
                        <img src="{{ asset('storage/' . $film->poster_url) }}" alt="{{ $film->title }}" class="w-full h-auto rounded-xl shadow-2xl border-2 border-slate-600 transform group-hover:scale-[1.02] transition-transform duration-300">
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>

                <div class="md:w-2/3 lg:w-3/4 flex flex-col">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg">{{ $film->title }}</h1>

                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-300 mb-6">
                        <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ $film->release_date->format('d F Y') }}</span>
                        <span class="text-slate-600">|</span>
                        <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> {{ $film->duration }} min</span>
                        <span class="text-slate-600">|</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">
                            {{ $film->age_rating }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach ($film->genres as $genre)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-700 text-gray-300 border border-slate-600 hover:bg-slate-600 hover:text-white transition-colors cursor-default">
                                {{ $genre->name }}
                            </span>
                        @endforeach
                    </div>

                    <p class="text-gray-400 text-lg leading-relaxed mb-8">
                        {{ $film->description }}
                    </p>

                    <div class="mt-auto">
                        <button wire:click="toggleWishlist"
                            class="inline-flex items-center px-6 py-3 text-sm font-bold rounded-lg shadow-lg transition-all transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-800
                            @if($isInWishlist)
                                bg-red-500 hover:bg-red-600 text-white focus:ring-red-500
                            @else
                                bg-amber-500 hover:bg-amber-600 text-slate-900 focus:ring-amber-500
                            @endif">
                            @if($isInWishlist)
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                Remove from Wishlist
                            @else
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Add to Wishlist
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-10 border-b border-slate-700 bg-slate-800">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Showtimes
            </h2>

            @if($film->showtimes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($film->showtimes as $showtime)
                        <div class="group bg-slate-900 border border-slate-700 p-5 rounded-xl hover:border-amber-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-amber-500/10 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-amber-500/10 to-transparent rounded-bl-full -mr-8 -mt-8 transition-all group-hover:from-amber-500/20"></div>

                            <div class="flex justify-between items-start mb-4 relative z-10">
                                <div>
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Studio</p>
                                    <p class="text-white font-semibold text-lg">{{ $showtime->studio->name }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-400 text-xs uppercase font-bold tracking-wider mb-1">Time</p>
                                    <p class="text-amber-500 font-bold text-xl">{{ $showtime->start_time->format('H:i') }}</p>
                                </div>
                            </div>

                            <a href="{{ route('user.bookings.seat-selection', ['showtime' => $showtime->id]) }}"
                               class="block w-full text-center bg-slate-800 hover:bg-amber-500 text-gray-300 hover:text-slate-900 font-bold py-2.5 rounded-lg border border-slate-700 hover:border-amber-500 transition-all duration-300">
                                Book Ticket
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 border-2 border-dashed border-slate-700 rounded-xl">
                    <p class="text-gray-500">No showtimes available for this movie yet.</p>
                </div>
            @endif
        </div>

        <div class="p-6 sm:p-10 bg-slate-800">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Reviews
            </h2>
            
            <div class="space-y-8">
                <!-- Form Tambah Ulasan -->
                @auth
                <div class="bg-slate-900 p-6 rounded-xl border border-slate-700">
                    <h3 class="text-lg font-bold text-white mb-4">Tulis Ulasan</h3>
                    <form wire:submit.prevent="addReview">
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm font-bold mb-2">Rating:</label>
                            <select wire:model="newRating" class="bg-slate-800 text-white border border-slate-700 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500">
                                <option value="5">⭐⭐⭐⭐⭐ (5 Bintang)</option>
                                <option value="4">⭐⭐⭐⭐ (4 Bintang)</option>
                                <option value="3">⭐⭐⭐ (3 Bintang)</option>
                                <option value="2">⭐⭐ (2 Bintang)</option>
                                <option value="1">⭐ (1 Bintang)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-400 text-sm font-bold mb-2">Ulasan Anda:</label>
                            <textarea wire:model.defer="newReview" rows="4" class="bg-slate-800 text-white border border-slate-700 rounded-lg w-full py-2 px-3 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Apa pendapat Anda tentang film ini?"></textarea>
                            @error('newReview') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold py-2.5 px-6 rounded-lg transition-all transform hover:scale-105">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>
                @else
                <div class="bg-slate-900 p-6 rounded-xl border border-slate-700 text-center">
                    <p class="text-gray-400 italic">Silakan <a href="{{ route('login') }}" class="text-amber-500 font-bold hover:underline">login</a> untuk memberikan rating dan ulasan.</p>
                </div>
                @endauth

                <!-- Daftar Ulasan -->
                <div class="space-y-4">
                    @forelse ($reviews as $review)
                        <div class="bg-slate-900 p-5 rounded-xl border border-slate-800 hover:border-slate-700 transition-colors">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center text-white font-bold mr-3 border border-slate-600">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-white">{{ $review->user->name }}</p>
                                        <p class="text-gray-500 text-xs">{{ $review->review_date->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex text-amber-500 text-xs">
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 {{ $i < $review->rating ? 'fill-current' : 'text-slate-700' }}" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed">{{ $review->review }}</p>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-500 bg-slate-900/50 rounded-xl border border-dashed border-slate-700">
                            <p>Belum ada ulasan untuk film ini. Jadi yang pertama mengulas!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
