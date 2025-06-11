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
    Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->integer('quantity');
    $table->decimal('total_price', 10, 2);
    $table->string('status')->default('lunas'); 
    $table->timestamps();
//     CREATE TABLE `tickets` (
//   `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   `user_id` BIGINT UNSIGNED NOT NULL,
//   `quantity` INT NOT NULL,
//   `total_price` DECIMAL(10, 2) NOT NULL,
//   `status` VARCHAR(255) NOT NULL DEFAULT 'lunas',
//   `created_at` TIMESTAMP NULL,
//   `updated_at` TIMESTAMP NULL,
//   CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
// ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
