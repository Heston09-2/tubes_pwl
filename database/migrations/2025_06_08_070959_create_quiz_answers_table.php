<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('quiz_answers', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('quiz_result_id');
    $table->unsignedBigInteger('question_id');
    $table->string('selected_option'); // Simpan 'A', 'B', 'C', atau 'D'
    $table->timestamps();

    $table->foreign('quiz_result_id')->references('id')->on('quiz_results')->onDelete('cascade');
    $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
