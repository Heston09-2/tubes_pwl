@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Kuis</h1>
        <a href="{{ route('admin.quizzes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Kuis
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4 overflow-x-auto">
        <table class="w-full table-auto min-w-full">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2">Judul</th>
                    <th class="p-2">Kategori</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quizzes as $quiz)
                    <tr class="border-t">
                        <td class="p-2">{{ $quiz->title }}</td>
                        <td class="p-2">{{ $quiz->category->name ?? '-' }}</td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="text-blue-600 hover:underline">Edit</a>

                            <a href="{{ route('admin.questions.index', ['quiz' => $quiz->id]) }}" class="text-green-600 hover:underline ml-2">Lihat Soal</a>

                            <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kuis ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-2 text-center text-gray-500">Belum ada kuis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
