@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Edit Materi</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-gray-700 font-medium mb-2">Judul Materi</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $material->title) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori</label>
            <select
                name="category_id"
                id="category_id"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $material->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="subcategory_id" class="block text-gray-700 font-medium mb-2">Subkategori</label>
            <select
                name="subcategory_id"
                id="subcategory_id"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $material->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                        {{ $subcategory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content" class="block text-gray-700 font-medium mb-2">Konten Materi</label>
            <textarea
                name="content"
                id="content"
                rows="6"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 resize-vertical"
            >{{ old('content', $material->content) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-gray-700 font-medium mb-2">Ganti Gambar (opsional)</label>
            <input
                type="file"
                name="image"
                id="image"
                class="block w-full text-gray-700"
            >
            @if ($material->image)
                <p class="mt-3">
                    Gambar saat ini:
                    <img src="{{ asset('storage/' . $material->image) }}" alt="Gambar" class="mt-2 w-32 rounded-md shadow-md">
                </p>
            @endif
        </div>

        <button
            type="submit"
            class="bg-blue-600 text-white font-semibold px-6 py-3 rounded-md hover:bg-blue-700 transition"
        >
            Update Materi
        </button>
    </form>
</div>
@endsection
