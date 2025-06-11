@extends('manager.layout.layout_manager')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-12 bg-gray-50 rounded-lg shadow-md">
    <h2 class="text-3xl font-semibold text-gray-800 mb-8 border-b pb-3">Edit Data Karya Seni</h2>

    <form action="{{ route('manager.artworks.update', $artwork->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-8 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $artwork->name) }}"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Nama"
                required>
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <input
                type="text"
                name="category"
                id="category"
                value="{{ old('category', $artwork->category) }}"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Kategori"
                required>
        </div>

        <div>
            <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Pembuat</label>
            <input
                type="text"
                name="creator"
                id="creator"
                value="{{ old('creator', $artwork->creator) }}"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Nama Pembuat"
                required>
        </div>

        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun <small class="text-gray-500">(boleh dikosongkan untuk tidak mengubah)</small></label>
            <input
                type="number"
                name="year"
                id="year"
                value="{{ old('year') }}"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Tahun">
            <p class="text-xs text-gray-500 mt-1 italic">Kosongkan jika tidak ingin mengubah tahun.</p>
        </div>

        <div>
            <label for="origin" class="block text-sm font-medium text-gray-700 mb-1">Asal</label>
            <input
                type="text"
                name="origin"
                id="origin"
                value="{{ old('origin', $artwork->origin) }}"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Asal"
                required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea
                name="description"
                id="description"
                class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Deskripsi"
                rows="4"
                required>{{ old('description', $artwork->description) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar (opsional)</label>
            <input
                type="file"
                name="image"
                id="image"
                class="w-full p-2 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex gap-4 justify-end">
            <a href="{{ route('manager.artworks.show') }}" class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600 transition">Batal</a>
            <button type="submit" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>

@endsection
