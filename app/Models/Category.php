<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function pelajars()
    {
        return $this->belongsToMany(Pelajar::class, 'category_pelajar', 'category_id', 'pelajar_id');
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }



}
