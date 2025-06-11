@extends('pelajar.layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Kategori Materi</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($categories as $category)
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
        @endforeach
    </div>
</div>
@endsection
