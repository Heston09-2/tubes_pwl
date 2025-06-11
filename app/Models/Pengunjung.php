<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';  // <-- Tambahkan ini

    protected $fillable = [
        'tanggal',
        'jumlah',
        'harga_tiket',
        'total_pendapatan',
        'is_final',
        'catatan',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
