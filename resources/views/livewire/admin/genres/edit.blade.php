<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
    
    <div class="mb-8">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
            Edit Genre
        </h1>
        <p class="text-gray-400 text-sm">Update genre information</p>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
        <form wire:submit.prevent="update">
            <div>
                <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Name
                </label>
                <input type="text" id="name" wire:model="name"
                    class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all shadow-inner"
                    placeholder="Enter genre name...">
                @error('name') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-slate-800">
                <a href="{{ route('admin.genres.index') }}"
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
