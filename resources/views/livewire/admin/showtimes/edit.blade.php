<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <div class="mb-8">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
            Edit Showtime
        </h1>
        <p class="text-gray-400 text-sm">Update showtime details</p>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Film Selection -->
                <div>
                    <label for="film_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                        </svg>
                        Film
                    </label>
                    <select id="film_id" wire:model="film_id"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner appearance-none">
                        <option value="">Select a film</option>
                        @foreach ($films as $film)
                            <option value="{{ $film->id }}">{{ $film->title }}</option>
                        @endforeach
                    </select>
                    @error('film_id') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Studio Selection -->
                <div>
                    <label for="studio_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Studio
                    </label>
                    <select id="studio_id" wire:model="studio_id"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner appearance-none">
                        <option value="">Select a studio</option>
                        @foreach ($studios as $studio)
                            <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                        @endforeach
                    </select>
                    @error('studio_id') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Date
                    </label>
                    <input type="date" id="date" wire:model="date"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner">
                    @error('date') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <!-- Time -->
                <div>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
