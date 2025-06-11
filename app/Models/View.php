<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    // Menentukan kolom yang boleh diisi secara massal
    protected $fillable = [
        'artwork_id',
        'viewed_at',
    ];

    // Relasi ke model Artwork (jika ingin ditambahkan relasi)
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
