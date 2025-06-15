@extends('pelajar.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">
        Subkategori dari: {{ $category->name }}
    </h1>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('pelajar.kategori.show', $category->id) }}" class="mb-6">
        <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">
            Filter berdasarkan subkategori:
        </label>
        <select name="subcategory_id" id="subcategory_id" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">Semua Subkategori</option>
            @foreach ($categorySubcategories as $subcategory)
                <option value="{{ $subcategory->id }}" {{ $filterId == $subcategory->id ? 'selected' : '' }}>
                    {{ $subcategory->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Daftar Subkategori -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($subcategories as $subcategory)
            <a href="{{ route('pelajar.materi.detail', $subcategory->id) }}"
               class="block bg-white rounded-lg shadow hover:shadow-lg p-6 transition">
                <h2 class="text-lg font-semibold text-sky-700">{{ $subcategory->name }}</h2>
                <p class="text-gray-600 mt-2">{{ $subcategory->description ?? 'Tidak ada deskripsi' }}</p>
            </a>
        @empty
            <p class="text-gray-500 col-span-full">Tidak ada subkategori yang sesuai dengan filter.</p>
        @endforelse
    </div>
</div>
@endsection
