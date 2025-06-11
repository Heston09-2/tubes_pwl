@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Materi: {{ $subcategory->name }}</h1>

@if ($materials->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($materials as $material)
            <div class="bg-white shadow rounded-lg p-4 hover:shadow-md transition">
                <h2 class="text-lg font-bold text-sky-700">{{ $material->title }}</h2>
                <p class="text-sm text-gray-600 mt-1">
                    Kategori: {{ $material->category->name }}<br>
                    Ditambahkan: {{ $material->created_at->format('d M Y') }}
                </p>
                <a href="{{ route('pelajar.materi.show', $material->id) }}" class="inline-block mt-3 text-blue-600 hover:underline text-sm font-semibold">
    Baca Selengkapnya
</a>

            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $materials->links() }}
    </div>
@else
    <p class="text-gray-500">Belum ada materi pada subkategori ini.</p>
@endif
@endsection
