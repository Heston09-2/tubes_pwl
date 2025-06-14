@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-6 shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Edit Forum</h2>

    <form action="{{ route('pelajar.forum.update', $forum) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title', $forum->title) }}"
                class="w-full mt-1 p-2 border rounded" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="5"
                class="w-full mt-1 p-2 border rounded" required>{{ old('description', $forum->description) }}</textarea>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Gambar (Opsional)</label>
            <input type="file" name="image" class="mt-1">
            @if ($forum->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $forum->image) }}" class="h-32 rounded border">
                </div>
            @endif
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('pelajar.forum.mine') }}" class="text-gray-600 hover:underline">← Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
