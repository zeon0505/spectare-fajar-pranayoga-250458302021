<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Transaksi</h1>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Kode Transaksi</th>
                <th class="border p-2">Total</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $i => $t)
            <tr>
                <td class="border p-2">{{ $i + 1 }}</td>
                <td class="border p-2">{{ $t->user->name }}</td>
                <td class="border p-2">{{ $t->code }}</td>
                <td class="border p-2">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                <td class="border p-2">
                    <span class="px-2 py-1 rounded {{ $t->status == 'paid' ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700' }}">
                        {{ ucfirst($t->status) }}
                    </span>
                </td>
                <td class="border p-2">{{ $t->created_at->format('d M Y H:i') }}</td>
                <td class="border p-2">
                    <a href="{{ route('transactions.detail', $t->id) }}" class="text-blue-600">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
