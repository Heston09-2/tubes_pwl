@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Materi</h1>

    <a href="{{ route('admin.categories.create') }}" class="text-blue-600 hover:underline">+ Tambah Kategori materi</a>
    <a href="{{ route('admin.subcategories.create') }}" class="text-blue-600 hover:underline">+ Tambah Subkategori materi</a>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Materi --}}
    <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        {{-- Judul Materi --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Judul Materi</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('title') }}" required>
        </div>

        {{-- Kategori --}}
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Subkategori --}}
        <div>
            <label for="subcategory_id" class="block text-sm font-medium text-gray-700">Subkategori</label>
            <select name="subcategory_id" id="subcategory_id" class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Pilih Subkategori</option>
                {{-- Kalau ada old input, tampilkan subkategori yang sesuai --}}
                @if(old('category_id'))
                    @foreach($categories->where('id', old('category_id'))->first()->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        {{-- Konten --}}
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Konten Materi</label>
            <textarea name="content" id="content" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('content') }}</textarea>
        </div>

        {{-- Gambar --}}
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Gambar (opsional)</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-700">
        </div>

        {{-- Tombol Submit --}}
        <div class="text-right">
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded shadow">
                Simpan Materi
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('category_id').addEventListener('change', function () {
        let categoryId = this.value;
        let subcategorySelect = document.getElementById('subcategory_id');

        // Kosongkan dulu option subkategori
        subcategorySelect.innerHTML = '<option value="">Memuat subkategori...</option>';

        if (categoryId) {
            fetch(`/admin/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Pilih Subkategori</option>';
                    data.forEach(subcategory => {
                        options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                    subcategorySelect.innerHTML = options;
                })
                .catch(() => {
                    subcategorySelect.innerHTML = '<option value="">Gagal memuat subkategori</option>';
                });
        } else {
            subcategorySelect.innerHTML = '<option value="">Pilih Subkategori</option>';
        }
    });
</script>
@endsection
