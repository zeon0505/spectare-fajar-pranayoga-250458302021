<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Jadwal Tayang</h1>

    <a href="{{ route('showtimes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Jadwal</a>

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">#</th>
                <th class="border p-2">Film</th>
                <th class="border p-2">Studio</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Waktu</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($showtimes as $index => $showtime)
                <tr>
                    <td class="border p-2">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $showtime->film->title }}</td>
                    <td class="border p-2">{{ $showtime->studio->name }}</td>
                    <td class="border p-2">{{ $showtime->date }}</td>
                    <td class="border p-2">{{ $showtime->time }}</td>
                    <td class="border p-2">Rp {{ number_format($showtime->price, 0, ',', '.') }}</td>
                    <td class="border p-2">
                        <a href="{{ route('showtimes.edit', $showtime->id) }}" class="text-blue-600">Edit</a> |
                        <button wire:click="delete({{ $showtime->id }})" class="text-red-600">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
