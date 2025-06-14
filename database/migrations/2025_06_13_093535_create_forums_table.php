<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelajar_id');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable(); // untuk upload gambar (optional)
            $table->timestamps();

            // Relasi ke tabel pelajars
            $table->foreign('pelajar_id')->references('id')->on('pelajars')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};

