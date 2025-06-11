<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class Material extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'subcategory_id',
        'admin_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function likes()
{
    return $this->hasMany(Like::class, 'material_id', 'id');
}

    public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}

}
