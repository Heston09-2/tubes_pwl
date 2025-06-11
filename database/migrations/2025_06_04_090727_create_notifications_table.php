<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // penerima notifikasi
            $table->foreignId('ticket_id')->nullable()->constrained()->onDelete('cascade'); // tiket terkait
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
//             CREATE TABLE `notifications` (
//     `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     `user_id` BIGINT UNSIGNED NOT NULL,
//     `ticket_id` BIGINT UNSIGNED NULL,
//     `title` VARCHAR(255) NOT NULL,
//     `message` TEXT NOT NULL,
//     `is_read` BOOLEAN NOT NULL DEFAULT FALSE,
//     `created_at` TIMESTAMP NULL,
//     `updated_at` TIMESTAMP NULL,
    
//     CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
//     CONSTRAINT `notifications_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE
// ) 

        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}

