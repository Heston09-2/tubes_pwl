@extends('admin.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-8 p-8 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
    <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Tambah Data</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-1">Nama</label>
            <input type="text" name="name" id="name" placeholder="Nama" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="category" class="block text-gray-700 font-semibold mb-1">Kategori</label>
            <input type="text" name="category" id="category" placeholder="Kategori" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="creator" class="block text-gray-700 font-semibold mb-1">Pembuat</label>
            <input type="text" name="creator" id="creator" placeholder="Nama pembuat" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="year" class="block text-gray-700 font-semibold mb-1">Tahun</label>
            <input type="number" name="year" id="year" placeholder="Tahun" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="origin" class="block text-gray-700 font-semibold mb-1">Asal</label>
            <input type="text" name="origin" id="origin" placeholder="Asal" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" placeholder="Deskripsi" required rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md resize-y focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <div>
            <label for="image" class="block text-gray-700 font-semibold mb-1">Gambar</label>
            <input type="file" name="image" id="image"
                class="block w-full text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="flex justify-end gap-4">
            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-900 transition">
                Simpan
            </button>
            <a href="{{ route('admin.show') }}" class="bg-gray-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-700 transition">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
