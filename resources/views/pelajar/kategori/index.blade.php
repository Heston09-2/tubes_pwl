@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Pilih Kategori</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach ($categories as $category)
        <a href="{{ route('pelajar.kategori.show', $category->id) }}" class="block bg-white rounded-lg shadow hover:shadow-lg p-6 transition">
            <h2 class="text-xl font-bold text-sky-700">{{ $category->name }}</h2>
            <p class="text-gray-600 mt-2">{{ $category->description ?? 'Tidak ada deskripsi' }}</p>
        </a>
    @endforeach
</div>
@endsection
