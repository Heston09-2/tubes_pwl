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
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);       // Nama karya, panjang 255 karakter
            $table->string('category', 100);   // Kategori karya, panjang 100 karakter
            $table->string('creator', 255);    // Nama pembuat, panjang 255 karakter
            $table->string('year', 50);        // Tahun (atau periode), panjang 50 karakter
            $table->string('origin', 100);     // Asal karya, panjang 100 karakter
            $table->text('description');       // Deskripsi karya
            $table->text('image');             // Jalur gambar, jika panjang
            $table->timestamps();
            //             CREATE TABLE artworks (
            //     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            //     name VARCHAR(255) NOT NULL,
            //     category VARCHAR(100) NOT NULL,
            //     creator VARCHAR(255) NOT NULL,
            //     year VARCHAR(50) NOT NULL,
            //     origin VARCHAR(100) NOT NULL,
            //     description TEXT NOT NULL,
            //     image TEXT NOT NULL,
            //     created_at TIMESTAMP NULL,
            //     updated_at TIMESTAMP NULL
            // );

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
