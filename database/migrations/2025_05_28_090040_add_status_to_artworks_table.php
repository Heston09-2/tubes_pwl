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
    Schema::table('artworks', function (Blueprint $table) {
        $table->string('status')->default('pending'); 
    });
    // ALTER TABLE artworks ADD COLUMN status VARCHAR(255) DEFAULT 'pending';

}

public function down()
{
    Schema::table('artworks', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
