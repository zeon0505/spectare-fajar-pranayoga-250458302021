<div class="max-w-4xl mx-auto p-6 sm:p-10">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-white drop-shadow-md">Detail Review</h1>
            <p class="text-gray-400 mt-1">Review dari pengguna untuk film</p>
        </div>
        <a href="{{ route('admin.reviews.index') }}" wire:navigate
           class="text-gray-400 hover:text-white font-semibold text-sm transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Reviews
        </a>
    </div>

    {{-- Main Review Card --}}
    <div class="bg-slate-900 rounded-2xl shadow-2xl shadow-black/30 border border-slate-800 overflow-hidden">
        <div class="p-8">
            {{-- User & Film Info --}}
            <div class="grid md:grid-cols-2 gap-8 mb-8">
                {{-- User Info --}}
                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-2xl font-black text-white shadow-lg">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Reviewer</p>
                            <h3 class="text-xl font-bold text-white">{{ $review->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $review->user->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Film Info --}}
                <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Film yang Direview</p>
                    <div class="flex items-center gap-4">
                        @if($review->film->poster_url)
                            <img src="{{ Str::startsWith($review->film->poster_url, 'http') ? $review->film->poster_url : Storage::url($review->film->poster_url) }}"
                                 class="w-16 h-24 object-cover rounded-lg shadow-lg border border-slate-600">
                        @else
                            <div class="w-16 h-24 bg-slate-700 rounded-lg flex items-center justify-center border border-slate-600">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $review->film->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $review->film->release_date->format('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rating Section --}}
            <div class="bg-gradient-to-br from-amber-500/10 to-orange-500/10 rounded-xl p-6 border border-amber-500/20 mb-8">
                <p class="text-xs font-bold text-amber-400 uppercase tracking-wider mb-3">Rating</p>
                <div class="flex items-center gap-3">
                    <div class="text-6xl font-black text-amber-500 drop-shadow-lg">
                        {{ $review->rating }}
                    </div>
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <svg class="w-8 h-8 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span class="text-gray-500 text-sm ml-2">dari 5 bintang</span>
                </div>
            </div>

            {{-- Comment Section --}}
            <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Komentar</p>
                </div>
                <p class="text-white leading-relaxed text-base">{{ $review->comment }}</p>
                <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Dibuat {{ $review->created_at->diffForHumans() }}
                </div>
            </div>

            {{-- Status Section --}}
            <div class="flex items-center justify-between p-6 bg-slate-800/50 rounded-xl border border-slate-700">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 {{ $review->is_approved ? 'text-green-500' : 'text-yellow-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($review->is_approved)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        @endif
                    </svg>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Review</p>
                        @if($review->is_approved)
                            <p class="text-lg font-bold text-green-500">Disetujui</p>
                        @else
                            <p class="text-lg font-bold text-yellow-500">Menunggu Persetujuan</p>
                        @endif
                    </div>
                </div>

                @if(!$review->is_approved)
                    <button wire:click="approve"
                            class="group flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-green-500 hover:from-green-500 hover:to-green-400 text-white font-bold rounded-xl transition-all shadow-lg shadow-green-600/20 hover:scale-105 hover:shadow-green-600/40">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Setujui Review
                    </button>
                @else
                    <div class="flex items-center gap-2 px-6 py-3 bg-green-500/10 text-green-500 font-bold rounded-xl border border-green-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sudah Disetujui
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
