<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Jadwal Tayang</h1>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label>Film</label>
            <select wire:model="film_id" class="w-full border rounded p-2">
                @foreach($films as $film)
                    <option value="{{ $film->id }}">{{ $film->title }}</option>
                @endforeach
            </select>
            @error('film_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Studio</label>
            <select wire:model="studio_id" class="w-full border rounded p-2">
                @foreach($studios as $studio)
                    <option value="{{ $studio->id }}">{{ $studio->name }}</option>
                @endforeach
            </select>
            @error('studio_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Tanggal</label>
            <input type="date" wire:model="date" class="w-full border rounded p-2">
            @error('date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Waktu</label>
            <input type="time" wire:model="time" class="w-full border rounded p-2">
            @error('time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Harga Tiket</label>
            <input type="number" wire:model="price" class="w-full border rounded p-2">
            @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
