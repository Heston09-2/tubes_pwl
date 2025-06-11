@extends('admin.layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Soal Kuis: {{ $quiz->title }}</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.questions.create', $quiz->id) }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Tambah Soal
    </a>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Pertanyaan</th>
                    <th class="px-4 py-2">A</th>
                    <th class="px-4 py-2">B</th>
                    <th class="px-4 py-2">C</th>
                    <th class="px-4 py-2">D</th>
                    <th class="px-4 py-2">Jawaban Benar</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($questions as $question)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $question->question_text }}</td>
                    <td class="px-4 py-2">{{ $question->option_a }}</td>
                    <td class="px-4 py-2">{{ $question->option_b }}</td>
                    <td class="px-4 py-2">{{ $question->option_c }}</td>
                    <td class="px-4 py-2">{{ $question->option_d }}</td>
                    <td class="px-4 py-2 font-bold">{{ $question->correct_answer }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.questions.edit', [$quiz->id, $question->id]) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.questions.destroy', [$quiz->id, $question->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Belum ada soal.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
