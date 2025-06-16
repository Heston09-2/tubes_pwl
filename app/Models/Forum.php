<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelajar_id',
        'title',
        'description',
        'image',
    ];

    // Relasi ke Pelajar
    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class);
    }

    // Relasi ke Komentar
    public function forumComments()
{
    return $this->hasMany(ForumComment::class);
}
    public function likes()
{
    return $this->hasMany(ForumLike::class);
}

public function isLikedBy($pelajarId)
{
    return $this->likes()->where('pelajar_id', $pelajarId)->exists();
}


}
