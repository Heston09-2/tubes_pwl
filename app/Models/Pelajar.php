<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Like;
use App\Models\Minat;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Quiz;

class Pelajar extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'umur', 'pendidikan'];

   
    public function likes()
{
    return $this->hasMany(Like::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}
public function categories()
{
    return $this->belongsToMany(Category::class);
}
public function minats()
{
    return $this->belongsToMany(Category::class, 'category_pelajar', 'pelajar_id', 'category_id');
}
// app/Models/Pelajar.php
public function likedMaterials()
{
    return $this->belongsToMany(Material::class, 'likes', 'pelajar_id', 'material_id')
                ->withTimestamps();
}
public function kuisYangSudahDikerjakan()
{
    return $this->belongsToMany(Quiz::class, 'pelajar_quiz')->withTimestamps();
}
public function hasilKuis()
{
    return $this->hasMany(QuizResult::class, 'pelajar_id');
}
public function forumLikes()
{
    return $this->hasMany(ForumLike::class);
}






}
