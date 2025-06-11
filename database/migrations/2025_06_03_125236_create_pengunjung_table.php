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
    Schema::create('pengunjung', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->unsignedInteger('jumlah');
        $table->unsignedBigInteger('harga_tiket'); // harga per orang
        $table->unsignedBigInteger('total_pendapatan'); // jumlah × harga
        $table->boolean('is_final')->default(false);
        $table->text('catatan')->nullable();
        $table->foreignId('admin_id')->constrained('users');
        $table->timestamps();

        $table->index('tanggal');
    });
//     CREATE TABLE pengunjung (
//     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     tanggal DATE NOT NULL,
//     jumlah INT UNSIGNED NOT NULL,
//     harga_tiket BIGINT UNSIGNED NOT NULL,
//     total_pendapatan BIGINT UNSIGNED NOT NULL,
//     is_final BOOLEAN DEFAULT FALSE,
//     catatan TEXT NULL,
//     admin_id BIGINT UNSIGNED NOT NULL,
//     created_at TIMESTAMP NULL,
//     updated_at TIMESTAMP NULL,
    
//     INDEX tanggal (tanggal),
//     CONSTRAINT pengunjung_admin_id_foreign FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
// );

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung');
    }
};
