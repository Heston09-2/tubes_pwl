@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">{{ $quiz->title }}</h1>

@if (session('success'))
    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded shadow">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('pelajar.quiz.submit', $quiz->id) }}" method="POST">
    @csrf

    @foreach($quiz->questions as $question)
        <div class="mb-6 p-4 border border-gray-200 rounded-lg shadow-sm">
            <p class="mb-3 font-semibold text-gray-800">
                Soal {{ $loop->iteration }}: {{ $question->question_text }}
            </p>

            @foreach (['A', 'B', 'C', 'D'] as $option)
                <div class="mb-2">
                    <label class="inline-flex items-center">
                        <input type="radio"
                            name="answers[{{ $question->id }}]"
                            value="{{ $option }}"
                            class="mr-2 text-blue-600 focus:ring-blue-500"
                            {{ old("answers.$question->id") === $option ? 'checked' : '' }}
                            required>
                        <span>{{ $option }}. {{ $question->{'option_'.strtolower($option)} }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    @endforeach

    <button type="submit" class="w-full md:w-auto px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        Kirim Jawaban
    </button>
</form>
@endsection
