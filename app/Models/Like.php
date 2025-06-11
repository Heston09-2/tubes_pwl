<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelajar;
use App\Models\Material;

class Like extends Model
{
    protected $fillable = ['pelajar_id', 'material_id'];

    public function pelajar() {
        return $this->belongsTo(Pelajar::class);
    }

    public function material() {
        return $this->belongsTo(Material::class);
    }
}

