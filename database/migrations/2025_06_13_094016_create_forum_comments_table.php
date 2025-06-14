<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('forum_comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('forum_id')->constrained()->onDelete('cascade');
        $table->foreignId('pelajar_id')->constrained()->onDelete('cascade');
        $table->text('content');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('forum_comments');
    }
};
