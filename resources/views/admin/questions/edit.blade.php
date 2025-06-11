@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Soal Kuis: {{ $quiz->title }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.questions.update', [$quiz->id, $question->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Pertanyaan</label>
            <textarea name="question_text" class="w-full border-gray-300 rounded shadow-sm" required>{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Opsi A</label>
            <input type="text" name="option_a" value="{{ old('option_a', $question->option_a) }}" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Opsi B</label>
            <input type="text" name="option_b" value="{{ old('option_b', $question->option_b) }}" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Opsi C</label>
            <input type="text" name="option_c" value="{{ old('option_c', $question->option_c) }}" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Opsi D</label>
            <input type="text" name="option_d" value="{{ old('option_d', $question->option_d) }}" class="w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div>
            <label class="block mb-1 font-medium">Jawaban Benar</label>
            <select name="correct_answer" class="w-full border-gray-300 rounded shadow-sm" required>
                <option value="A" {{ old('correct_answer', $question->correct_answer) == 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('correct_answer', $question->correct_answer) == 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('correct_answer', $question->correct_answer) == 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('correct_answer', $question->correct_answer) == 'D' ? 'selected' : '' }}>D</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui Soal</button>
    </form>
</div>
@endsection
