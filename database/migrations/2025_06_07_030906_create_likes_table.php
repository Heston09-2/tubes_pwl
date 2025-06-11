<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelajar_id');
            $table->unsignedBigInteger('material_id');
            $table->timestamps();

            $table->foreign('pelajar_id')->references('id')->on('pelajars')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');

            $table->unique(['pelajar_id', 'material_id']); // Optional: supaya tidak ada duplikat like
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
