<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['pelajar_id', 'name', 'email', 'message'];

    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class);
    }
}

