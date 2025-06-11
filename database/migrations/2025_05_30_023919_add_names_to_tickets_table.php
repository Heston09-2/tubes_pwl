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
    Schema::table('tickets', function (Blueprint $table) {
        $table->text('names')->nullable();  // kolom untuk simpan JSON string nama-nama
    });
    // ALTER TABLE `tickets` ADD `names` TEXT NULL;

}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropColumn('names');
    });
}

};
