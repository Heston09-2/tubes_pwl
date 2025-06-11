@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Pilih Kategori Kuis</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach ($categories as $category)
        <a href="{{ route('pelajar.quizzes.byCategory', $category->id) }}" class="block p-4 bg-white rounded shadow hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-blue-700">{{ $category->name }}</h2>
            <p class="text-gray-600 text-sm mt-1">{{ $category->quizzes_count }} kuis tersedia</p>
        </a>
    @endforeach
</div>
@endsection
