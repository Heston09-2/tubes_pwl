<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Favorite;
use App\Models\View; 

class Artwork extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi secara massal
    protected $fillable = [
        'name', 
        'category', 
        'creator', 
        'year', 
        'origin', 
        'description', 
        'image',
       'status',
        

    ];


    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}
// Di Artwork.php
public function favorites()
{
    return $this->hasMany(Favorite::class);
}
public function views()
{
    return $this->hasMany(View::class);
}



}
