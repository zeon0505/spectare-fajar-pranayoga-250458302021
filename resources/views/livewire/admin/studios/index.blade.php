<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Studio 🎬</h1>

    <a href="{{ route('studios.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Tambah Studio</a>

    <table class="mt-4 w-full border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Nama Studio</th>
                <th class="p-2 border">Kapasitas</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studios as $studio)
                <tr>
                    <td class="p-2 border">{{ $studio->name }}</td>
                    <td class="p-2 border">{{ $studio->capacity }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('studios.edit', $studio->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
