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
        // Membuat tabel 'views' untuk menyimpan data kunjungan karya
        Schema::create('views', function (Blueprint $table) {
            $table->id(); // Kolom id (primary key, auto increment)

            // Kolom foreign key ke tabel 'artworks', jika artwork dihapus, maka view juga ikut terhapus (cascade)
            $table->foreignId('artwork_id')->constrained()->onDelete('cascade');

            // Kolom foreign key ke tabel 'users', bisa null (untuk pengunjung tak login), jika user dihapus maka nilai jadi null
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Menyimpan alamat IP pengunjung (bisa null)
            $table->ipAddress('ip_address')->nullable();

            // Kolom created_at dan updated_at otomatis
            $table->timestamps();
        });

        /**
         * 
         * CREATE TABLE `views` (
         *   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         *   `artwork_id` BIGINT UNSIGNED NOT NULL,
         *   `user_id` BIGINT UNSIGNED NULL,
         *   `ip_address` VARCHAR(45) NULL,
         *   `created_at` TIMESTAMP NULL,
         *   `updated_at` TIMESTAMP NULL,
         *   FOREIGN KEY (`artwork_id`) REFERENCES `artworks`(`id`) ON DELETE CASCADE,
         *   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
         * ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
         */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'views' jika rollback
        Schema::dropIfExists('views');
    }
};
