@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Tambah Soal Kuis: {{ $quiz->title }}</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.questions.store', $quiz->id) }}" method="POST" id="soalForm">
        @csrf

        <div id="questions-container" class="space-y-6">
            <div class="question-item bg-white p-6 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Soal 1</h2>
                <div class="mb-3">
                    <label class="block font-medium mb-1">Pertanyaan</label>
                    <textarea name="question_text[]" class="w-full border-gray-300 rounded" required></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Opsi A</label>
                        <input type="text" name="option_a[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi B</label>
                        <input type="text" name="option_b[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi C</label>
                        <input type="text" name="option_c[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi D</label>
                        <input type="text" name="option_d[]" class="w-full border-gray-300 rounded" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium mb-1">Jawaban Benar</label>
                    <select name="correct_answer[]" class="w-full border-gray-300 rounded" required>
                        <option value="">Pilih jawaban benar</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <button type="button" onclick="removeQuestion(this)" class="mt-4 text-red-600 hover:underline">🗑 Hapus soal ini</button>
            </div>
        </div>

        <div class="mt-6">
            <button type="button" onclick="addQuestion()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">+ Tambah Soal Lagi</button>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Semua Soal</button>
        </div>
    </form>
</div>

<script>
    let questionCount = 1;

    function addQuestion() {
        questionCount++;
        const container = document.getElementById('questions-container');
        const questionHTML = `
            <div class="question-item bg-white p-6 rounded shadow-md">
                <h2 class="text-lg font-semibold mb-4">Soal ${questionCount}</h2>
                <div class="mb-3">
                    <label class="block font-medium mb-1">Pertanyaan</label>
                    <textarea name="question_text[]" class="w-full border-gray-300 rounded" required></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Opsi A</label>
                        <input type="text" name="option_a[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi B</label>
                        <input type="text" name="option_b[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi C</label>
                        <input type="text" name="option_c[]" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Opsi D</label>
                        <input type="text" name="option_d[]" class="w-full border-gray-300 rounded" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-medium mb-1">Jawaban Benar</label>
                    <select name="correct_answer[]" class="w-full border-gray-300 rounded" required>
                        <option value="">Pilih jawaban benar</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>

                <button type="button" onclick="removeQuestion(this)" class="mt-4 text-red-600 hover:underline">🗑 Hapus soal ini</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', questionHTML);
    }

    function removeQuestion(button) {
        const questionItem = button.closest('.question-item');
        questionItem.remove();
    }
</script>
@endsection
