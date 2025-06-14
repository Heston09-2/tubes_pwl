<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
        'pelajar_id',
        'content',
       
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class);
    }

    
    
}
