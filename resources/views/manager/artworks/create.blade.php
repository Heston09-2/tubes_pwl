@extends('manager.layout.layout_manager')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Tambah Data Karya Seni</h2>

    <form action="{{ route('manager.artworks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name" placeholder="Nama karya seni"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <input type="text" name="category" id="category" placeholder="Kategori"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Pembuat</label>
            <input type="text" name="creator" id="creator" placeholder="Nama pembuat"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
            <input type="number" name="year" id="year" placeholder="Tahun pembuatan"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="origin" class="block text-sm font-medium text-gray-700 mb-1">Asal</label>
            <input type="text" name="origin" id="origin" placeholder="Asal karya seni"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" placeholder="Deskripsi singkat"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" required></textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
            <input type="file" name="image" id="image"
                class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                       file:rounded-md file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-50 file:text-blue-700
                       hover:file:bg-blue-100" />
        </div>

        <div class="flex justify-end gap-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition">Simpan</button>
            <a href="{{ route('manager.artworks.show') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-5 py-2 rounded-md transition">Batal</a>
        </div>
    </form>
</div>
@endsection
