<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Film 🎬</h1>
    <a href="{{ route('films.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">Tambah Film</a>

    <table class="mt-4 w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Genre</th>
                <th class="p-2 border">Durasi</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
                <tr>
                    <td class="border p-2">{{ $film->title }}</td>
                    <td class="border p-2">{{ $film->genre }}</td>
                    <td class="border p-2">{{ $film->duration }} menit</td>
                    <td class="border p-2">
                        <a href="{{ route('films.edit', $film->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
