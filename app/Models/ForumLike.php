<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelajar_id',
        'forum_id',
    ];

    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class);
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}
