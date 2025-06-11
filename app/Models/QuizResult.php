<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = ['pelajar_id', 'quiz_id', 'score', 'completed_at', 'quiz_updated_at'];


    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class); // sesuaikan dengan nama model pelajar kamu
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
