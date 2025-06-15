<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['pelajar_id', 'material_id', 'content'];

public function pelajar()
{
    return $this->belongsTo(Pelajar::class, 'pelajar_id');
}

    public function material() {
        return $this->belongsTo(Material::class);
    }

    
}
