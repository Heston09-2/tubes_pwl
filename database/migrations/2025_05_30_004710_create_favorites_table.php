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
       Schema::create('favorites', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('artwork_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    $table->unique(['user_id', 'artwork_id']);

//     CREATE TABLE favorites (
//     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     user_id BIGINT UNSIGNED NOT NULL,
//     artwork_id BIGINT UNSIGNED NOT NULL,
//     created_at TIMESTAMP NULL,
//     updated_at TIMESTAMP NULL,
//     UNIQUE KEY unique_user_artwork (user_id, artwork_id),
//     CONSTRAINT favorites_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
//     CONSTRAINT favorites_artwork_id_foreign FOREIGN KEY (artwork_id) REFERENCES artworks(id) ON DELETE CASCADE
// );

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
