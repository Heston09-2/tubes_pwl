@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $quiz->title }}</h1>

<form action="{{ route('pelajar.quiz.submit', $quiz->id) }}" method="POST">
    @csrf

    @foreach($quiz->questions as $question)
        <div class="mb-6 p-4 border rounded">
            <p class="mb-2 font-semibold">Soal {{ $loop->iteration }}: {{ $question->question_text }}</p>

            @foreach(['A', 'B', 'C', 'D'] as $option)
                <label class="block mb-1">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" required>
                    {{ $option }}. {{ $question->{'option_' . strtolower($option)} }}
                </label>
            @endforeach
        </div>
    @endforeach

    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Kirim Jawaban</button>
</form>
@endsection
