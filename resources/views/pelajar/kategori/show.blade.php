@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Subkategori dari: {{ $category->name }}</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse ($subcategories as $subcategory)
        <a href="{{ route('pelajar.materi.detail', $subcategory->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg p-6 transition">
            <h2 class="text-lg font-semibold text-sky-700">{{ $subcategory->name }}</h2>
            <p class="text-gray-600 mt-2">{{ $subcategory->description ?? 'Tidak ada deskripsi' }}</p>
        </a>
    @empty
        <p class="text-gray-500">Belum ada subkategori untuk kategori ini.</p>
    @endforelse
</div>
@endsection
