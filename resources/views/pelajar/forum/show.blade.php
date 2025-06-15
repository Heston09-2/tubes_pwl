@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 p-4 bg-white shadow rounded-lg">
    {{-- Judul dan isi forum --}}
    <h1 class="text-3xl font-bold mb-2">{{ $forum->title }}</h1>
    <p class="text-gray-600 mb-4">Oleh {{ $forum->pelajar->name ?? 'Anonim' }}</p>
    <p class="mb-4">{{ $forum->description }}</p>

    @if ($forum->image)
        <img src="{{ asset('storage/' . $forum->image) }}" class="mb-6 rounded max-h-96 object-cover">
    @endif

    {{-- Form komentar --}}
    <div class="mt-6 border-t pt-4">
        <h2 class="text-xl font-semibold mb-2">Tulis Komentar</h2>

        <form action="{{ route('pelajar.forum.comment', $forum) }}" method="POST">
            @csrf
            <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="Tulis komentar kamu..." required></textarea>
            <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kirim Komentar
            </button>
        </form>
    </div>

    {{-- Daftar komentar --}}
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Komentar</h2>

        @forelse ($comments as $comment)
            <div class="border-t py-3 flex items-start space-x-3">
                {{-- Foto profil dengan inisial --}}
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-semibold text-sm">
                        {{ substr($comment->pelajar->name ?? 'P', 0, 1) }}
                    </span>
                </div>
                
                {{-- Konten komentar --}}
                <div class="flex-1">
                    <p class="text-sm text-gray-700 font-semibold">{{ $comment->pelajar->name ?? 'Anonim' }}</p>
                    <p class="mt-1">{{ $comment->content }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada komentar.</p>
        @endforelse
    </div>
</div>
@endsection