<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-2 drop-shadow-md">Featured Films Management</h1>
        <p class="text-gray-400">Manage films for "Popular Now" and "Coming Soon" sections on the dashboard.</p>
    </div>

    <!-- Search Section -->
    <div class="bg-slate-800 rounded-xl shadow-lg border border-slate-700 p-6 mb-8 relative z-50">
        <label class="block text-sm font-bold text-gray-400 mb-2">Add Film to Featured</label>
        <div class="relative">
            <input type="text" wire:model.live.debounce.300ms="search"
                class="w-full bg-slate-900 text-white border border-slate-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent placeholder-gray-600"
                placeholder="Search film title...">
            
            @if(strlen($search) > 2 && count($searchResults) > 0)
                <div class="absolute w-full mt-2 bg-slate-800 border border-slate-600 rounded-lg shadow-xl overflow-hidden z-50">
                    @foreach($searchResults as $film)
                        <div class="p-3 hover:bg-slate-700 flex justify-between items-center border-b border-slate-700 last:border-0">
                            <div class="flex items-center gap-3">
                                <img src="{{ Str::startsWith($film->poster_url, 'http') ? $film->poster_url : Storage::url($film->poster_url) }}" 
                                     class="w-8 h-12 object-cover rounded">
                                <div>
                                    <div class="font-bold text-white">{{ $film->title }}</div>
                                    <div class="text-xs text-gray-400">{{ $film->release_date->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="addFilm('{{ $film->id }}', 'now_showing')" 
                                        class="px-3 py-1 bg-amber-500/20 text-amber-500 hover:bg-amber-500 hover:text-slate-900 rounded text-xs font-bold transition-colors">
                                    + Popular Now
                                </button>
                                <button wire:click="addFilm('{{ $film->id }}', 'coming_soon')" 
                                        class="px-3 py-1 bg-blue-500/20 text-blue-500 hover:bg-blue-500 hover:text-white rounded text-xs font-bold transition-colors">
                                    + Coming Soon
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Popular Now Section -->
        <div class="bg-slate-800 rounded-xl shadow-lg border border-slate-700 p-6">
            <h2 class="text-xl font-bold text-amber-500 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                Popular Now (Now Showing)
            </h2>
            
            <ul wire:sortable="updateOrder" class="space-y-3">
                @forelse($nowShowing as $item)
                    <li wire:sortable.item="{{ $item->id }}" wire:key="ns-{{ $item->id }}" class="bg-slate-900 p-3 rounded-lg border border-slate-700 flex items-center justify-between group cursor-move">
                        <div class="flex items-center gap-3">
                            <div wire:sortable.handle class="text-gray-500 cursor-grab hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </div>
                            <img src="{{ Str::startsWith($item->film->poster_url, 'http') ? $item->film->poster_url : Storage::url($item->film->poster_url) }}" 
                                 class="w-10 h-14 object-cover rounded shadow-sm">
                            <div>
                                <div class="font-bold text-white">{{ $item->film->title }}</div>
                                <div class="text-xs text-gray-500">{{ $item->film->duration }} min</div>
                            </div>
                        </div>
                        <button wire:click="removeFilm('{{ $item->id }}')" class="text-gray-500 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </li>
                @empty
                    <li class="text-gray-500 text-center py-8 italic border border-dashed border-slate-700 rounded-lg">
                        No films selected. Dashboard will show latest films automatically.
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Coming Soon Section -->
        <div class="bg-slate-800 rounded-xl shadow-lg border border-slate-700 p-6">
            <h2 class="text-xl font-bold text-blue-500 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Coming Soon
            </h2>
            
            <ul wire:sortable="updateOrder" class="space-y-3">
                @forelse($comingSoon as $item)
                    <li wire:sortable.item="{{ $item->id }}" wire:key="cs-{{ $item->id }}" class="bg-slate-900 p-3 rounded-lg border border-slate-700 flex items-center justify-between group cursor-move">
                        <div class="flex items-center gap-3">
                            <div wire:sortable.handle class="text-gray-500 cursor-grab hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </div>
                            <img src="{{ Str::startsWith($item->film->poster_url, 'http') ? $item->film->poster_url : Storage::url($item->film->poster_url) }}" 
                                 class="w-10 h-14 object-cover rounded shadow-sm">
                            <div>
                                <div class="font-bold text-white">{{ $item->film->title }}</div>
                                <div class="text-xs text-gray-500">{{ $item->film->release_date->format('d M Y') }}</div>
                            </div>
                        </div>
                        <button wire:click="removeFilm('{{ $item->id }}')" class="text-gray-500 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </li>
                @empty
                    <li class="text-gray-500 text-center py-8 italic border border-dashed border-slate-700 rounded-lg">
                        No films selected. Dashboard will show latest films automatically.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
