<div class="p-8">
    <h2 class="text-2xl font-bold text-white mb-6">Manajemen Ulasan</h2>

    <div class="card-cinema card-hover p-6 rounded-lg mb-8">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari berdasarkan komentar, nama pengguna, atau judul film..." class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
    </div>

    <div class="overflow-x-auto card-cinema rounded-lg">
        <table class="w-full text-sm text-left text-gray-300">
            <thead class="text-xs text-amber-400 uppercase bg-slate-900/50">
                <tr>
                    <th scope="col" class="px-6 py-3">Pengguna</th>
                    <th scope="col" class="px-6 py-3">Film</th>
                    <th scope="col" class="px-6 py-3">Rating</th>
                    <th scope="col" class="px-6 py-3">Komentar</th>
                    <th scope="col" class="px-6 py-3 text-center">Status</th>
                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr class="border-b border-slate-800 hover:bg-slate-800/50">
                        <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                            {{ $review->user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $review->film->title }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.368-2.448a1 1 0 00-1.175 0l-3.368 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-xs font-semibold">{{ number_format($review->rating, 1) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::limit($review->comment, 60) }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($review->is_approved)
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Disetujui</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Menunggu</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('admin.reviews.show', $review->id) }}" class="font-medium text-blue-500 hover:underline">Detail</a>
                            @if($review->is_approved)
                                <button onclick="confirmUnapprove('{{ $review->id }}')" class="font-medium text-yellow-500 hover:underline">Batal</button>
                            @else
                                <button onclick="confirmApprove('{{ $review->id }}')" class="font-medium text-green-500 hover:underline">Setujui</button>
                            @endif
                            <button onclick="confirmDelete('{{ $review->id }}')" class="font-medium text-red-500 hover:underline">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-400">
                            Tidak ada ulasan yang cocok dengan pencarian Anda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $reviews->links() }}
    </div>

    <script>
        function confirmApprove(id) {
            Swal.fire({
                title: 'Setujui Review?',
                text: "Review ini akan disetujui dan ditampilkan kepada publik.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Setujui!',
                cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('approve', id);
                    Swal.fire({
                        title: 'Disetujui!',
                        text: 'Review telah disetujui.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#1e293b',
                        color: '#fff'
                    });
                }
            });
        }

        function confirmUnapprove(id) {
            Swal.fire({
                title: 'Batalkan Persetujuan?',
                text: "Review ini akan disembunyikan dari publik.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('unapprove', id);
                    Swal.fire({
                        title: 'Dibatalkan!',
                        text: 'Persetujuan review telah dibatalkan.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#1e293b',
                        color: '#fff'
                    });
                }
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Review?',
                text: "Data ini tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                background: '#1e293b',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', id);
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Review telah dihapus.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#1e293b',
                        color: '#fff'
                    });
                }
            });
        }
    </script>
</div>
