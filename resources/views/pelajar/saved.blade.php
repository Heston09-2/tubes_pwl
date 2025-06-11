@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-bold text-sky-700 mb-6">Materi yang Disimpan</h1>

        @forelse($savedMaterials as $material)
            <div class="mb-6 p-4 border border-gray-200 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-sky-800">{{ $material->title }}</h2>
                <p class="text-sm text-gray-500">
                    {{ $material->created_at->format('d M Y') }} • 
                    Kategori: {{ $material->category->name }}
                </p>
                <a href="{{ route('pelajar.materi.show', $material->id) }}" class="text-blue-600 hover:underline">
                    Lihat Materi →
                </a>
            </div>
        @empty
            <p class="text-gray-500">Belum ada materi yang disimpan.</p>
        @endforelse

        <div class="mt-4">
            {{ $savedMaterials->links() }}
        </div>
    </div>
</div>
@endsection
