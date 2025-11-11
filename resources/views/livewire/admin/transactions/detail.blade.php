<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Transaksi</h1>

    <div class="bg-white p-4 rounded shadow">
        <p><strong>Kode Transaksi:</strong> {{ $transaction->code }}</p>
        <p><strong>User:</strong> {{ $transaction->user->name }}</p>
        <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
        <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
    </div>

    <h2 class="text-xl font-semibold mt-6 mb-2">Tiket Dipesan</h2>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Film</th>
                <th class="border p-2">Studio</th>
                <th class="border p-2">Kursi</th>
                <th class="border p-2">Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->bookingSeats as $seat)
            <tr>
                <td class="border p-2">{{ $seat->showtime->film->title }}</td>
                <td class="border p-2">{{ $seat->showtime->studio->name }}</td>
                <td class="border p-2">{{ $seat->seat_number }}</td>
                <td class="border p-2">Rp {{ number_format($seat->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('transactions.index') }}" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded">
        Kembali
    </a>
</div>
