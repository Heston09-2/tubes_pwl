@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Subkategori</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.subcategories.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Pilih Kategori Induk -->
        <div>
            <label class="block mb-1 text-sm font-medium">Kategori Induk</label>
            <select name="category_id" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Subkategori -->
        <div>
            <label class="block mb-1 text-sm font-medium">Nama Subkategori</label>
            <div id="subcategory-container">
                <div class="subcategory-group mb-2">
                    <input type="text" name="names[]" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-2" placeholder="Nama Subkategori" required>
                </div>
            </div>
            <button type="button" onclick="addSubcategoryInput()" class="bg-gray-300 text-black px-3 py-1 rounded hover:bg-gray-400 mt-2">+ Tambah Subkategori</button>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>

<!-- Tambah input subkategori secara dinamis -->
<script>
    function addSubcategoryInput() {
        const container = document.getElementById('subcategory-container');
        const group = document.createElement('div');
        group.className = 'subcategory-group mb-2';
        group.innerHTML = `
            <input type="text" name="names[]" class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-2" placeholder="Nama Subkategori" required>
        `;
        container.appendChild(group);
    }
</script>
@endsection
