<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <div class="mb-8">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
            Create Showtime
        </h1>
        <p class="text-gray-400 text-sm">Schedule a new showtime for your cinema</p>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                
                <!-- Film Selection -->
                <div x-data="{ 
                    open: false, 
                    selectedFilmId: @entangle('film_id').live,
                    selectedFilmTitle: '',
                    films: {{ json_encode($films->map(fn($f) => ['id' => $f->id, 'title' => $f->title])) }}
                }" @keydown.escape.window="open = false" class="relative">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                        </svg>
                        Film
                    </label>
                    <button type="button" @click="open = !open"
                        class="relative w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 text-left focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                        <span class="block truncate text-sm">
                            <span x-show="!selectedFilmId" class="text-gray-500">Select a film</span>
                            <span x-show="selectedFilmId" x-text="films.find(f => f.id == selectedFilmId)?.title || 'Select a film'"></span>
                        </span>
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 7.03 7.78a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3zm-3.78 9.53a.75.75 0 011.06 0L10 15.19l2.97-2.97a.75.75 0 111.06 1.06l-3.5 3.5a.75.75 0 01-1.06 0l-3.5-3.5a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="absolute z-10 mt-1 w-full bg-slate-800 shadow-xl max-h-60 rounded-xl py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm border border-slate-700"
                        style="display: none;">
                        <template x-for="film in films" :key="film.id">
                            <button type="button" @click="selectedFilmId = film.id; open = false"
                                class="text-gray-300 w-full text-left relative cursor-pointer select-none py-2.5 pl-4 pr-9 hover:bg-slate-700 transition-colors"
                                :class="{ 'bg-slate-700': selectedFilmId == film.id }">
                                <span class="block truncate text-sm" x-text="film.title"></span>
                                <span x-show="selectedFilmId == film.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-amber-500">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        </template>
                    </div>
                    @error('film_id') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Studio Selection -->
                <div x-data="{ 
                    open: false, 
                    selectedStudioId: @entangle('studio_id').live,
                    studios: {{ json_encode($studios->map(fn($s) => ['id' => $s->id, 'name' => $s->name])) }}
                }" @keydown.escape.window="open = false" class="relative">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Studio
                    </label>
                    <button type="button" @click="open = !open"
                        class="relative w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 text-left focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                        <span class="block truncate text-sm">
                            <span x-show="!selectedStudioId" class="text-gray-500">Select a studio</span>
                            <span x-show="selectedStudioId" x-text="studios.find(s => s.id == selectedStudioId)?.name || 'Select a studio'"></span>
                        </span>
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.53.22l3.5 3.5a.75.75 0 01-1.06 1.06L10 4.81 7.03 7.78a.75.75 0 01-1.06-1.06l3.5-3.5A.75.75 0 0110 3zm-3.78 9.53a.75.75 0 011.06 0L10 15.19l2.97-2.97a.75.75 0 111.06 1.06l-3.5 3.5a.75.75 0 01-1.06 0l-3.5-3.5a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="absolute z-10 mt-1 w-full bg-slate-800 shadow-xl max-h-60 rounded-xl py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm border border-slate-700"
                        style="display: none;">
                        <template x-for="studio in studios" :key="studio.id">
                            <button type="button" @click="selectedStudioId = studio.id; open = false"
                                class="text-gray-300 w-full text-left relative cursor-pointer select-none py-2.5 pl-4 pr-9 hover:bg-slate-700 transition-colors"
                                :class="{ 'bg-slate-700': selectedStudioId == studio.id }">
                                <span class="block truncate text-sm" x-text="studio.name"></span>
                                <span x-show="selectedStudioId == studio.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-amber-500">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        </template>
                    </div>
                    @error('studio_id') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div>
                    <label for="start_date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Start Date
                    </label>
                    <input type="date" id="start_date" wire:model="start_date"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                    @error('start_date') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- End Date -->
                <div>
                    <label for="end_date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        End Date
                    </label>
                    <input type="date" id="end_date" wire:model="end_date"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                    @error('end_date') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Time -->
                <div class="md:col-span-2">
                    <label for="time" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Time
                    </label>
                    <input type="time" id="time" wire:model="time"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                    @error('time') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-slate-800">
                <a href="{{ route('admin.showtimes.index') }}"
                   class="px-6 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-slate-800 font-bold text-sm transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create Showtime
                </button>
            </div>
        </form>
    </div>
</div>
