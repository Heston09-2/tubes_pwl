<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropQuizAnswersTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('quiz_answers');
    }

    public function down()
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_result_id');
            $table->unsignedBigInteger('question_id');
            $table->string('selected_option'); // kolom baru untuk menyimpan jawaban langsung, contoh 'A','B', dst.
            $table->timestamps();

            $table->foreign('quiz_result_id')->references('id')->on('quiz_results')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }
}
