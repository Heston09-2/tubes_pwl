@extends('pelajar.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Hasil Kuis: {{ $result->quiz->title }}</h1>
<p class="mb-2">Skor Anda: <span class="font-semibold">{{ $result->score }} dari {{ $result->quiz->questions->count() }}</span></p>

@foreach ($result->quiz->questions as $question)
    <div class="mb-4 p-4 border rounded">
        <p class="font-semibold mb-1">Soal: {{ $question->question_text }}</p>
        @php
            // Cari jawaban pelajar untuk soal ini
            $answer = $result->answers->firstWhere('question_id', $question->id);
            $jawaban = $answer ? $answer->selected_option : '-';
            $isCorrect = $jawaban === $question->correct_answer;
        @endphp
        <p class="text-sm mb-1">Jawaban Anda: 
            <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                {{ $jawaban }}
            </span>
        </p>
        <p class="text-sm">Kunci Jawaban: <span class="font-bold">{{ $question->correct_answer }}</span></p>
    </div>
@endforeach


<div class="mt-6">
    <a href="{{ route('pelajar.quizzes.index') }}" 
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow transition">
        ← Kembali ke Daftar Kuis
    </a>
</div>
@endsection
