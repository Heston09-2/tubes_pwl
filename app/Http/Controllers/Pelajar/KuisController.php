<?php

namespace App\Http\Controllers\Pelajar;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\QuizResult;
use App\Models\QuizAnswer;

class KuisController extends Controller
{
    // Menampilkan semua kategori (opsional)
    public function index()
    {
        $categories = Category::withCount('quizzes')->get(); // untuk tampilan awal

        return view('pelajar.quizzes.index', compact('categories'));
    }

    // Menampilkan semua kuis untuk kategori tertentu
    public function quizzesByCategory($id)
    {
        $category = Category::with('quizzes.questions')->findOrFail($id);

        return view('pelajar.quizzes.by_category', [
            'category' => $category,
            'quizzes' => $category->quizzes
        ]);
    }

    // Menampilkan detail dan soal kuis
  public function show(Quiz $quiz)
{
    $quiz->load('questions');

    $pelajar = auth()->user();

    $existingResult = QuizResult::where('pelajar_id', $pelajar->id)
        ->where('quiz_id', $quiz->id)
        ->latest()
        ->first();

    // Cek apakah perlu mengulang kuis
    $needsRedo = !$existingResult || $existingResult->quiz_updated_at < $quiz->updated_at;

    if ($needsRedo) {
        // Hapus hasil lama jika ada (termasuk jawaban)
        if ($existingResult) {
            QuizAnswer::where('quiz_result_id', $existingResult->id)->delete();
            $existingResult->delete();
        }

        return view('pelajar.quizzes.show', compact('quiz'))
            ->with('message', 'Kuis ini telah diperbarui oleh admin. Silakan kerjakan ulang.');
    }

    // Jika tidak perlu mengulang, redirect ke hasil
    return redirect()->route('pelajar.quiz.result', $existingResult->id);
}

    // Menangani pengumpulan jawaban kuis
public function submit(Request $request, Quiz $quiz)
{
    $request->validate([
        'answers' => 'required|array',
        'answers.*' => 'required|in:A,B,C,D',
    ]);

    $pelajar = auth()->user();
    $questions = $quiz->questions;
    $score = 0;

    // Simpan hasil kuis terlebih dahulu
  $result = QuizResult::create([
    'pelajar_id' => $pelajar->id,
    'quiz_id' => $quiz->id,
    'score' => 0, // sementara
    'completed_at' => now(),
    'quiz_updated_at' => $quiz->updated_at, // ⬅️ tambahan penting
]);


    foreach ($questions as $question) {
        $jawaban = $request->input("answers.{$question->id}");
        $isCorrect = $jawaban === $question->correct_answer;

        QuizAnswer::create([
            'quiz_result_id' => $result->id,
            'question_id' => $question->id,
            'selected_option' => $jawaban,  // simpan huruf A/B/C/D langsung
        ]);

        if ($isCorrect) {
            $score++;
        }
    }

    $result->update(['score' => $score]);

    return redirect()->route('pelajar.quiz.result', $result->id);
}


public function result(QuizResult $result)
{
    $result->load('quiz.questions', 'answers.question');

    return view('pelajar.quizzes.result', compact('result'));
}




}
