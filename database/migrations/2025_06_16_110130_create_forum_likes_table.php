<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('forum_likes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelajar_id')->constrained()->onDelete('cascade');
        $table->foreignId('forum_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        $table->unique(['pelajar_id', 'forum_id']); // agar 1 pelajar hanya bisa like 1x
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_likes');
    }
};
