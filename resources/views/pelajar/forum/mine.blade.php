@extends('pelajar.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 p-4 bg-white shadow rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Forum yang Kamu Buat</h2>

    @foreach ($forums as $forum)
        <div class="border-b py-4">
            <h3 class="text-xl font-semibold">{{ $forum->title }}</h3>
            <p class="text-sm text-gray-600 mb-2">{{ \Illuminate\Support\Str::limit($forum->description, 100) }}</p>

            @if ($forum->image)
                <img src="{{ asset('storage/' . $forum->image) }}" alt="Forum Image" class="w-full max-h-64 object-cover rounded mb-3">
            @endif

            <div class="flex items-center gap-3">
                <a href="{{ route('pelajar.forum.edit', $forum) }}" class="text-blue-600 hover:underline">Edit</a>

              <form action="{{ route('pelajar.forum.destroy', $forum) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus forum ini?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
</form>

            </div>
        </div>
    @endforeach
</div>
@endsection
