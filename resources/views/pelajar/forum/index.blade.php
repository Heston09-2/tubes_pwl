@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Forum Diskusi Pelajar</h1>
        <a href="{{ route('pelajar.forum.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            + Buat Topik Baru
        </a>
    </div>

    @forelse ($forums as $forum)
        <div class="bg-white border rounded-lg shadow-sm mb-6">
            {{-- Header --}}
            <div class="flex items-center px-4 py-3">
                <img src="{{ asset('images/avatar.png') }}" class="w-10 h-10 rounded-full object-cover mr-3" alt="Avatar">
                <div>
                    <div class="font-semibold text-gray-800">{{ $forum->pelajar->nama ?? 'Anonim' }}</div>
                    <div class="text-sm text-gray-500">{{ $forum->created_at->diffForHumans() }}</div>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-4 pb-3">
                <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $forum->title }}</h2>
                <p class="text-gray-700 mb-3">{{ $forum->description }}</p>

                @if ($forum->image)
                    <img src="{{ asset('storage/' . $forum->image) }}" alt="Gambar Forum" class="w-full max-h-96 object-cover rounded-md mb-3">
                @endif
            </div>

            {{-- Footer --}}
            <div class="flex items-center justify-between px-4 py-2 border-t">
                <div class="flex items-center gap-6 text-gray-600 text-sm">
                    <button class="flex items-center gap-1 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M3 10a7 7 0 1014 0 7 7 0 10-14 0zm8-4v3h2l-3 3-3-3h2V6h2z"/></svg>
                        Suka
                    </button>

                    <a href="#" class="flex items-center gap-1 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 20 20"><path d="M18 10c0 3.866-3.582 7-8 7a8.962 8.962 0 01-4.9-1.5L2 17l1.5-3.1A7.966 7.966 0 012 10c0-3.866 3.582-7 8-7s8 3.134 8 7z"/></svg>
                        Komentar
                    </a>
                </div>

                <a href="{{ route('pelajar.forum.show', $forum) }}" class="text-blue-600 text-sm hover:underline">
                    Lihat Diskusi →
                </a>
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500 mt-10">
            Belum ada diskusi. Ayo buat topik pertama kamu!
        </div>
    @endforelse
</div>
@endsection
