@extends('pelajar.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-sky-700">Daftar Kuis untuk Kategori: {{ $category->name }}</h1>

    @if ($quizzes->count())
        @php
            $pelajar = auth('pelajar')->user();
            $hasilKuis = $pelajar->hasilKuis->keyBy('quiz_id'); // hasilKuis = relasi ke QuizResult
        @endphp

        <div class="space-y-6 max-w-4xl mx-auto">
            @foreach ($quizzes as $quiz)
                @php
                    $result = $hasilKuis->get($quiz->id);
                    $needsRedo = $result && $result->quiz_updated_at < $quiz->updated_at;
                @endphp

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <h2 class="text-xl font-semibold text-sky-700 mb-2">{{ $quiz->title }}</h2>
                    <p class="text-gray-600 mb-3">{{ $quiz->description ?? 'Tidak ada deskripsi' }}</p>
                    <p class="text-sm text-gray-500 mb-4">Jumlah soal: <span class="font-medium">{{ $quiz->questions->count() }}</span></p>

                    @if ($result && !$needsRedo)
                        <div class="flex items-center space-x-3">
                            <span class="inline-block px-4 py-2 bg-green-100 text-green-700 rounded font-medium select-none">
                                ✅ Sudah dikerjakan
                            </span>
                            <a href="{{ route('pelajar.quiz.result', $result->id) }}"
                               class="inline-block px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition-colors duration-200">
                                📄 Lihat Hasil
                            </a>
                        </div>
                    @elseif ($needsRedo)
                        <div class="flex items-center space-x-3">
                            <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-700 rounded font-medium select-none">
                                🔁 Soal diperbarui
                            </span>
                            <a href="{{ route('pelajar.quiz.take', $quiz->id) }}"
                               class="inline-block px-5 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 transition-colors duration-200">
                                Kerjakan Ulang
                            </a>
                        </div>
                    @else
                        <a href="{{ route('pelajar.quiz.take', $quiz->id) }}"
                           class="inline-block px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-200">
                            Kerjakan Kuis
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 italic mt-10">Belum ada kuis di kategori ini.</p>
    @endif
</div>
@endsection
