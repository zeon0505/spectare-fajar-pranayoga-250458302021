<div class="relative w-full max-w-xl mx-auto" x-data="{ focused: false }">
    <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-amber-500 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input 
            wire:model.live.debounce.300ms="search"
            @focus="focused = true"
            @blur="setTimeout(() => focused = false, 200)"
            type="text" 
            class="block w-full pl-10 pr-3 py-2 border border-slate-700 rounded-full leading-5 bg-slate-800 text-gray-300 placeholder-gray-500 focus:outline-none focus:bg-slate-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 sm:text-sm transition-all duration-200 shadow-sm" 
            placeholder="Search films, genres, or actors..."
            autocomplete="off"
        >
        
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
             <div wire:loading class="animate-spin h-4 w-4 text-amber-500">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>

    @if(strlen($search) >= 2)
        <div x-show="focused" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute z-50 mt-2 w-full bg-slate-800 rounded-xl shadow-2xl border border-slate-700 overflow-hidden"
             style="display: none;">
            
            @if(count($searchResults) > 0)
                <div class="max-h-96 overflow-y-auto custom-scrollbar">
                    <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-slate-900/50">
                        Films
                    </div>
                    @foreach($searchResults as $film)
                        <a href="{{ route('user.films.show', $film->id) }}" class="block px-4 py-3 hover:bg-slate-700/50 transition-colors duration-150 border-b border-slate-700/50 last:border-0 group">
                            <div class="flex items-center">
                                <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                     alt="{{ $film->title }}" 
                                     class="h-12 w-8 object-cover rounded shadow-sm group-hover:shadow-amber-500/20 transition-all duration-200">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-white group-hover:text-amber-500 transition-colors duration-200">
                                        {{ $film->title }}
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $film->release_date->format('Y') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="px-4 py-6 text-center text-gray-400">
                    <svg class="mx-auto h-8 w-8 text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm">No films found for "<span class="text-amber-500 font-medium">{{ $search }}</span>"</p>
                </div>
            @endif
        </div>
    @endif
</div>
