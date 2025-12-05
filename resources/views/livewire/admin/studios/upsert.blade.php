<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="mb-8">
        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-500 to-amber-300 drop-shadow-sm mb-2">
            {{ $studio?->id ? 'Edit Studio' : 'Add Studio' }}
        </h1>
        <p class="text-gray-400 text-sm">{{ $studio?->id ? 'Update studio information' : 'Add a new studio to your cinema' }}</p>
    </div>

    <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Name
                    </label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 placeholder-gray-500 transition-all shadow-inner"
                        placeholder="e.g., Studio 1">
                    @error('name') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="location" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Location
                    </label>
                    <input type="text" id="location" wire:model="location"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 placeholder-gray-500 transition-all shadow-inner"
                        placeholder="e.g., Jakarta / 1st Floor">
                    @error('location') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Capacity
                    </label>
                    <input type="number" id="capacity" wire:model="capacity"
                        class="w-full bg-slate-800/50 text-white border border-slate-700 rounded-xl py-3 px-4 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 placeholder-gray-500 transition-all shadow-inner"
                        placeholder="e.g., 150">
                    @error('capacity') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="image" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Studio Image
                    </label>
                    <input type="file" id="image" wire:model="image"
                        class="block w-full text-sm text-gray-400
                               border border-slate-700 rounded-xl cursor-pointer
                               bg-slate-800/50 focus:outline-none
                               file:mr-4 file:py-3 file:px-6
                               file:rounded-l-xl file:border-0
                               file:text-xs file:font-bold file:uppercase file:tracking-wider
                               file:bg-amber-500 file:text-slate-900
                               hover:file:bg-amber-600 transition-all">

                    <div wire:loading wire:target="image" class="mt-2 text-amber-500 text-xs font-medium">Uploading...</div>

                    @error('image') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span> @enderror

                    @if ($image)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-wider">New Image Preview:</p>
                            <img src="{{ $image->temporaryUrl() }}" class="w-64 h-auto rounded-xl shadow-lg border border-slate-700 object-cover">
                        </div>
                    @elseif ($existingImage)
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 mb-2 font-bold uppercase tracking-wider">Current Image:</p>
                            <img src="{{ asset('storage/' . $existingImage) }}" class="w-64 h-auto rounded-xl shadow-lg border border-slate-700 object-cover opacity-80">
                        </div>
                    @endif
                </div>

            </div>

            <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-slate-800">
                <a href="{{ route('admin.studios.index') }}"
                    class="px-6 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-slate-800 font-bold text-sm transition-all">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-900 font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
