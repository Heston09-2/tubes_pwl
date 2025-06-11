<?php

// app/Http/Controllers/Admin/QuestionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->latest()->get();
        return view('admin.questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
{
    $validated = $request->validate([
        'question_text.*' => 'required|string',
        'option_a.*' => 'required|string',
        'option_b.*' => 'required|string',
        'option_c.*' => 'required|string',
        'option_d.*' => 'required|string',
        'correct_answer.*' => 'required|in:A,B,C,D',
    ]);

    $jumlahSoal = count($validated['question_text']);

    for ($i = 0; $i < $jumlahSoal; $i++) {
        $quiz->questions()->create([
            'question_text' => $validated['question_text'][$i],
            'option_a' => $validated['option_a'][$i],
            'option_b' => $validated['option_b'][$i],
            'option_c' => $validated['option_c'][$i],
            'option_d' => $validated['option_d'][$i],
            'correct_answer' => $validated['correct_answer'][$i],
        ]);
    }

    // Pastikan updated_at pada quiz ikut berubah
    $quiz->touch();

    return redirect()->route('admin.questions.index', $quiz->id)
        ->with('success', 'Semua soal berhasil ditambahkan.');
}



    public function edit(Quiz $quiz, Question $question)
    {
        return view('admin.questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
{
    $validated = $request->validate([
        'question_text' => 'required',
        'option_a' => 'required',
        'option_b' => 'required',
        'option_c' => 'required',
        'option_d' => 'required',
        'correct_answer' => 'required|in:A,B,C,D',
    ]);

    $question->update($validated);

    // Update updated_at pada quiz supaya pelajar tahu kuis diupdate
    $quiz->touch();

    return redirect()->route('admin.questions.index', $quiz->id)->with('success', 'Soal berhasil diperbarui.');
}

    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index', $quiz->id)->with('success', 'Soal berhasil dihapus.');
    }
}
