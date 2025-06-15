@extends('pelajar.layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <!-- Judul Halaman -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Kategori Materi</h1>

        <!-- Dropdown Filter Kategori -->
        <form method="GET" action="{{ route('pelajar.materi') }}" class="inline-block">
            <select name="category" onchange="this.form.submit()" class="px-4 py-2 border rounded-lg text-gray-700">
                <option value="">Semua Kategori</option>
                @foreach ($allCategories as $cat)
                    <option value="{{ $cat->id }}" {{ $selectedCategoryId == $cat->id ? 'selected' : '' }}>
                        {{ ucfirst($cat->name) }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Daftar Kategori -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($categories as $category)
            <a href="{{ route('pelajar.kategori.show', $category->id) }}" class="block rounded-2xl overflow-hidden shadow-lg bg-white border border-gray-200 transition-all duration-300">

                {{-- Gambar --}}
                @if ($category->randomImage)
                    <div class="w-full h-48 bg-gray-100">
                        <img src="{{ asset('storage/' . $category->randomImage) }}" alt="{{ $category->name }}"
                             class="w-full h-full object-cover object-center">
                    </div>
                @else
                    <div class="w-full h-48 bg-gradient-to-r from-gray-100 to-gray-200 flex items-center justify-center text-gray-400 text-sm italic">
                        Tidak ada gambar
                    </div>
                @endif

                {{-- Konten --}}
                <div class="p-5 bg-white">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $category->name }}</h2>
                    <p class="text-sm text-gray-600">Lihat subkategori & materi</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500">
                Tidak ada kategori ditemukan.
            </div>
        @endforelse
    </div>
</div>
@endsection
